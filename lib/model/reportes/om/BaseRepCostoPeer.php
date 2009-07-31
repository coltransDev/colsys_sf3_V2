<?php


abstract class BaseRepCostoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_repaduanadet';

	
	const CLASS_DEFAULT = 'lib.model.reportes.RepCosto';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const OID = 'tb_repaduanadet.OID';

	
	const CA_IDREPORTE = 'tb_repaduanadet.CA_IDREPORTE';

	
	const CA_IDCOSTO = 'tb_repaduanadet.CA_IDCOSTO';

	
	const CA_TIPO = 'tb_repaduanadet.CA_TIPO';

	
	const CA_VLRCOSTO = 'tb_repaduanadet.CA_VLRCOSTO';

	
	const CA_MINCOSTO = 'tb_repaduanadet.CA_MINCOSTO';

	
	const CA_NETCOSTO = 'tb_repaduanadet.CA_NETCOSTO';

	
	const CA_IDMONEDA = 'tb_repaduanadet.CA_IDMONEDA';

	
	const CA_DETALLES = 'tb_repaduanadet.CA_DETALLES';

	
	const CA_FCHCREADO = 'tb_repaduanadet.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_repaduanadet.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_repaduanadet.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_repaduanadet.CA_USUACTUALIZADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Oid', 'CaIdreporte', 'CaIdcosto', 'CaTipo', 'CaVlrcosto', 'CaMincosto', 'CaNetcosto', 'CaIdmoneda', 'CaDetalles', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('oid', 'caIdreporte', 'caIdcosto', 'caTipo', 'caVlrcosto', 'caMincosto', 'caNetcosto', 'caIdmoneda', 'caDetalles', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::OID, self::CA_IDREPORTE, self::CA_IDCOSTO, self::CA_TIPO, self::CA_VLRCOSTO, self::CA_MINCOSTO, self::CA_NETCOSTO, self::CA_IDMONEDA, self::CA_DETALLES, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('oid', 'ca_idreporte', 'ca_idcosto', 'ca_tipo', 'ca_vlrcosto', 'ca_mincosto', 'ca_netcosto', 'ca_idmoneda', 'ca_detalles', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Oid' => 0, 'CaIdreporte' => 1, 'CaIdcosto' => 2, 'CaTipo' => 3, 'CaVlrcosto' => 4, 'CaMincosto' => 5, 'CaNetcosto' => 6, 'CaIdmoneda' => 7, 'CaDetalles' => 8, 'CaFchcreado' => 9, 'CaUsucreado' => 10, 'CaFchactualizado' => 11, 'CaUsuactualizado' => 12, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('oid' => 0, 'caIdreporte' => 1, 'caIdcosto' => 2, 'caTipo' => 3, 'caVlrcosto' => 4, 'caMincosto' => 5, 'caNetcosto' => 6, 'caIdmoneda' => 7, 'caDetalles' => 8, 'caFchcreado' => 9, 'caUsucreado' => 10, 'caFchactualizado' => 11, 'caUsuactualizado' => 12, ),
		BasePeer::TYPE_COLNAME => array (self::OID => 0, self::CA_IDREPORTE => 1, self::CA_IDCOSTO => 2, self::CA_TIPO => 3, self::CA_VLRCOSTO => 4, self::CA_MINCOSTO => 5, self::CA_NETCOSTO => 6, self::CA_IDMONEDA => 7, self::CA_DETALLES => 8, self::CA_FCHCREADO => 9, self::CA_USUCREADO => 10, self::CA_FCHACTUALIZADO => 11, self::CA_USUACTUALIZADO => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('oid' => 0, 'ca_idreporte' => 1, 'ca_idcosto' => 2, 'ca_tipo' => 3, 'ca_vlrcosto' => 4, 'ca_mincosto' => 5, 'ca_netcosto' => 6, 'ca_idmoneda' => 7, 'ca_detalles' => 8, 'ca_fchcreado' => 9, 'ca_usucreado' => 10, 'ca_fchactualizado' => 11, 'ca_usuactualizado' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new RepCostoMapBuilder();
		}
		return self::$mapBuilder;
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
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(RepCostoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RepCostoPeer::OID);

		$criteria->addSelectColumn(RepCostoPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(RepCostoPeer::CA_IDCOSTO);

		$criteria->addSelectColumn(RepCostoPeer::CA_TIPO);

		$criteria->addSelectColumn(RepCostoPeer::CA_VLRCOSTO);

		$criteria->addSelectColumn(RepCostoPeer::CA_MINCOSTO);

		$criteria->addSelectColumn(RepCostoPeer::CA_NETCOSTO);

		$criteria->addSelectColumn(RepCostoPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(RepCostoPeer::CA_DETALLES);

		$criteria->addSelectColumn(RepCostoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(RepCostoPeer::CA_USUCREADO);

		$criteria->addSelectColumn(RepCostoPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(RepCostoPeer::CA_USUACTUALIZADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepCostoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepCostoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseRepCostoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepCostoPeer', $criteria, $con);
    }


				$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}
	
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = RepCostoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return RepCostoPeer::populateObjects(RepCostoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepCostoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseRepCostoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			RepCostoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(RepCosto $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getOid();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof RepCosto) {
				$key = (string) $value->getOid();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or RepCosto object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} 
	
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; 	}
	
	
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
				if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = RepCostoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = RepCostoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = RepCostoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				RepCostoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinReporte(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepCostoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepCostoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepCostoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseRepCostoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepCostoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinCosto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepCostoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepCostoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepCostoPeer::CA_IDCOSTO,), array(CostoPeer::CA_IDCOSTO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseRepCostoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepCostoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinReporte(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseRepCostoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseRepCostoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepCostoPeer::addSelectColumns($c);
		$startcol = (RepCostoPeer::NUM_COLUMNS - RepCostoPeer::NUM_LAZY_LOAD_COLUMNS);
		ReportePeer::addSelectColumns($c);

		$c->addJoin(array(RepCostoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepCostoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepCostoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = RepCostoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepCostoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = ReportePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ReportePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ReportePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ReportePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepCosto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinCosto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepCostoPeer::addSelectColumns($c);
		$startcol = (RepCostoPeer::NUM_COLUMNS - RepCostoPeer::NUM_LAZY_LOAD_COLUMNS);
		CostoPeer::addSelectColumns($c);

		$c->addJoin(array(RepCostoPeer::CA_IDCOSTO,), array(CostoPeer::CA_IDCOSTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepCostoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepCostoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = RepCostoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepCostoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = CostoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = CostoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CostoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					CostoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepCosto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepCostoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepCostoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepCostoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$criteria->addJoin(array(RepCostoPeer::CA_IDCOSTO,), array(CostoPeer::CA_IDCOSTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepCostoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepCostoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}

	
	public static function doSelectJoinAll(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseRepCostoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseRepCostoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepCostoPeer::addSelectColumns($c);
		$startcol2 = (RepCostoPeer::NUM_COLUMNS - RepCostoPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		CostoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (CostoPeer::NUM_COLUMNS - CostoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(RepCostoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$c->addJoin(array(RepCostoPeer::CA_IDCOSTO,), array(CostoPeer::CA_IDCOSTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepCostoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepCostoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepCostoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepCostoPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = ReportePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = ReportePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ReportePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ReportePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepCosto($obj1);
			} 
			
			$key3 = CostoPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = CostoPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = CostoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					CostoPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addRepCosto($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptReporte(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepCostoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(RepCostoPeer::CA_IDCOSTO,), array(CostoPeer::CA_IDCOSTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepCostoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepCostoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptCosto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepCostoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(RepCostoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepCostoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepCostoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptReporte(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseRepCostoPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseRepCostoPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepCostoPeer::addSelectColumns($c);
		$startcol2 = (RepCostoPeer::NUM_COLUMNS - RepCostoPeer::NUM_LAZY_LOAD_COLUMNS);

		CostoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CostoPeer::NUM_COLUMNS - CostoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(RepCostoPeer::CA_IDCOSTO,), array(CostoPeer::CA_IDCOSTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepCostoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepCostoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepCostoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepCostoPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = CostoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = CostoPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = CostoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CostoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepCosto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptCosto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepCostoPeer::addSelectColumns($c);
		$startcol2 = (RepCostoPeer::NUM_COLUMNS - RepCostoPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(RepCostoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepCostoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepCostoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepCostoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepCostoPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = ReportePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ReportePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ReportePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ReportePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepCosto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array();
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return RepCostoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepCostoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRepCostoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseRepCostoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseRepCostoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepCostoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRepCostoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(RepCostoPeer::OID);
			$selectCriteria->add(RepCostoPeer::OID, $criteria->remove(RepCostoPeer::OID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseRepCostoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseRepCostoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(RepCostoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												RepCostoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof RepCosto) {
						RepCostoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RepCostoPeer::OID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								RepCostoPeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public static function doValidate(RepCosto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RepCostoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RepCostoPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(RepCostoPeer::DATABASE_NAME, RepCostoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RepCostoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = RepCostoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(RepCostoPeer::DATABASE_NAME);
		$criteria->add(RepCostoPeer::OID, $pk);

		$v = RepCostoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(RepCostoPeer::DATABASE_NAME);
			$criteria->add(RepCostoPeer::OID, $pks, Criteria::IN);
			$objs = RepCostoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseRepCostoPeer::DATABASE_NAME)->addTableBuilder(BaseRepCostoPeer::TABLE_NAME, BaseRepCostoPeer::getMapBuilder());

