<?php


abstract class BaseRepTarifaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_reptarifas';

	
	const CLASS_DEFAULT = 'lib.model.reportes.RepTarifa';

	
	const NUM_COLUMNS = 18;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const OID = 'tb_reptarifas.OID';

	
	const CA_IDREPORTE = 'tb_reptarifas.CA_IDREPORTE';

	
	const CA_IDCONCEPTO = 'tb_reptarifas.CA_IDCONCEPTO';

	
	const CA_CANTIDAD = 'tb_reptarifas.CA_CANTIDAD';

	
	const CA_NETA_TAR = 'tb_reptarifas.CA_NETA_TAR';

	
	const CA_NETA_MIN = 'tb_reptarifas.CA_NETA_MIN';

	
	const CA_NETA_IDM = 'tb_reptarifas.CA_NETA_IDM';

	
	const CA_REPORTAR_TAR = 'tb_reptarifas.CA_REPORTAR_TAR';

	
	const CA_REPORTAR_MIN = 'tb_reptarifas.CA_REPORTAR_MIN';

	
	const CA_REPORTAR_IDM = 'tb_reptarifas.CA_REPORTAR_IDM';

	
	const CA_COBRAR_TAR = 'tb_reptarifas.CA_COBRAR_TAR';

	
	const CA_COBRAR_MIN = 'tb_reptarifas.CA_COBRAR_MIN';

	
	const CA_COBRAR_IDM = 'tb_reptarifas.CA_COBRAR_IDM';

	
	const CA_OBSERVACIONES = 'tb_reptarifas.CA_OBSERVACIONES';

	
	const CA_FCHCREADO = 'tb_reptarifas.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_reptarifas.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_reptarifas.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_reptarifas.CA_USUACTUALIZADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Oid', 'CaIdreporte', 'CaIdconcepto', 'CaCantidad', 'CaNetaTar', 'CaNetaMin', 'CaNetaIdm', 'CaReportarTar', 'CaReportarMin', 'CaReportarIdm', 'CaCobrarTar', 'CaCobrarMin', 'CaCobrarIdm', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('oid', 'caIdreporte', 'caIdconcepto', 'caCantidad', 'caNetaTar', 'caNetaMin', 'caNetaIdm', 'caReportarTar', 'caReportarMin', 'caReportarIdm', 'caCobrarTar', 'caCobrarMin', 'caCobrarIdm', 'caObservaciones', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::OID, self::CA_IDREPORTE, self::CA_IDCONCEPTO, self::CA_CANTIDAD, self::CA_NETA_TAR, self::CA_NETA_MIN, self::CA_NETA_IDM, self::CA_REPORTAR_TAR, self::CA_REPORTAR_MIN, self::CA_REPORTAR_IDM, self::CA_COBRAR_TAR, self::CA_COBRAR_MIN, self::CA_COBRAR_IDM, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('oid', 'ca_idreporte', 'ca_idconcepto', 'ca_cantidad', 'ca_neta_tar', 'ca_neta_min', 'ca_neta_idm', 'ca_reportar_tar', 'ca_reportar_min', 'ca_reportar_idm', 'ca_cobrar_tar', 'ca_cobrar_min', 'ca_cobrar_idm', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Oid' => 0, 'CaIdreporte' => 1, 'CaIdconcepto' => 2, 'CaCantidad' => 3, 'CaNetaTar' => 4, 'CaNetaMin' => 5, 'CaNetaIdm' => 6, 'CaReportarTar' => 7, 'CaReportarMin' => 8, 'CaReportarIdm' => 9, 'CaCobrarTar' => 10, 'CaCobrarMin' => 11, 'CaCobrarIdm' => 12, 'CaObservaciones' => 13, 'CaFchcreado' => 14, 'CaUsucreado' => 15, 'CaFchactualizado' => 16, 'CaUsuactualizado' => 17, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('oid' => 0, 'caIdreporte' => 1, 'caIdconcepto' => 2, 'caCantidad' => 3, 'caNetaTar' => 4, 'caNetaMin' => 5, 'caNetaIdm' => 6, 'caReportarTar' => 7, 'caReportarMin' => 8, 'caReportarIdm' => 9, 'caCobrarTar' => 10, 'caCobrarMin' => 11, 'caCobrarIdm' => 12, 'caObservaciones' => 13, 'caFchcreado' => 14, 'caUsucreado' => 15, 'caFchactualizado' => 16, 'caUsuactualizado' => 17, ),
		BasePeer::TYPE_COLNAME => array (self::OID => 0, self::CA_IDREPORTE => 1, self::CA_IDCONCEPTO => 2, self::CA_CANTIDAD => 3, self::CA_NETA_TAR => 4, self::CA_NETA_MIN => 5, self::CA_NETA_IDM => 6, self::CA_REPORTAR_TAR => 7, self::CA_REPORTAR_MIN => 8, self::CA_REPORTAR_IDM => 9, self::CA_COBRAR_TAR => 10, self::CA_COBRAR_MIN => 11, self::CA_COBRAR_IDM => 12, self::CA_OBSERVACIONES => 13, self::CA_FCHCREADO => 14, self::CA_USUCREADO => 15, self::CA_FCHACTUALIZADO => 16, self::CA_USUACTUALIZADO => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('oid' => 0, 'ca_idreporte' => 1, 'ca_idconcepto' => 2, 'ca_cantidad' => 3, 'ca_neta_tar' => 4, 'ca_neta_min' => 5, 'ca_neta_idm' => 6, 'ca_reportar_tar' => 7, 'ca_reportar_min' => 8, 'ca_reportar_idm' => 9, 'ca_cobrar_tar' => 10, 'ca_cobrar_min' => 11, 'ca_cobrar_idm' => 12, 'ca_observaciones' => 13, 'ca_fchcreado' => 14, 'ca_usucreado' => 15, 'ca_fchactualizado' => 16, 'ca_usuactualizado' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new RepTarifaMapBuilder();
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
		return str_replace(RepTarifaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RepTarifaPeer::OID);

		$criteria->addSelectColumn(RepTarifaPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(RepTarifaPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(RepTarifaPeer::CA_CANTIDAD);

		$criteria->addSelectColumn(RepTarifaPeer::CA_NETA_TAR);

		$criteria->addSelectColumn(RepTarifaPeer::CA_NETA_MIN);

		$criteria->addSelectColumn(RepTarifaPeer::CA_NETA_IDM);

		$criteria->addSelectColumn(RepTarifaPeer::CA_REPORTAR_TAR);

		$criteria->addSelectColumn(RepTarifaPeer::CA_REPORTAR_MIN);

		$criteria->addSelectColumn(RepTarifaPeer::CA_REPORTAR_IDM);

		$criteria->addSelectColumn(RepTarifaPeer::CA_COBRAR_TAR);

		$criteria->addSelectColumn(RepTarifaPeer::CA_COBRAR_MIN);

		$criteria->addSelectColumn(RepTarifaPeer::CA_COBRAR_IDM);

		$criteria->addSelectColumn(RepTarifaPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(RepTarifaPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(RepTarifaPeer::CA_USUCREADO);

		$criteria->addSelectColumn(RepTarifaPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(RepTarifaPeer::CA_USUACTUALIZADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepTarifaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepTarifaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseRepTarifaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepTarifaPeer', $criteria, $con);
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
		$objects = RepTarifaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return RepTarifaPeer::populateObjects(RepTarifaPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepTarifaPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseRepTarifaPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			RepTarifaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(RepTarifa $obj, $key = null)
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
			if (is_object($value) && $value instanceof RepTarifa) {
				$key = (string) $value->getOid();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or RepTarifa object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = RepTarifaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = RepTarifaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = RepTarifaPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				RepTarifaPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinReporte(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepTarifaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepTarifaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepTarifaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseRepTarifaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepTarifaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinConcepto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepTarifaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepTarifaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepTarifaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseRepTarifaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepTarifaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseRepTarifaPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseRepTarifaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepTarifaPeer::addSelectColumns($c);
		$startcol = (RepTarifaPeer::NUM_COLUMNS - RepTarifaPeer::NUM_LAZY_LOAD_COLUMNS);
		ReportePeer::addSelectColumns($c);

		$c->addJoin(array(RepTarifaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepTarifaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepTarifaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = RepTarifaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepTarifaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addRepTarifa($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinConcepto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepTarifaPeer::addSelectColumns($c);
		$startcol = (RepTarifaPeer::NUM_COLUMNS - RepTarifaPeer::NUM_LAZY_LOAD_COLUMNS);
		ConceptoPeer::addSelectColumns($c);

		$c->addJoin(array(RepTarifaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepTarifaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepTarifaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = RepTarifaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepTarifaPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = ConceptoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ConceptoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ConceptoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ConceptoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepTarifa($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepTarifaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepTarifaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepTarifaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$criteria->addJoin(array(RepTarifaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepTarifaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepTarifaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseRepTarifaPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseRepTarifaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepTarifaPeer::addSelectColumns($c);
		$startcol2 = (RepTarifaPeer::NUM_COLUMNS - RepTarifaPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(RepTarifaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$c->addJoin(array(RepTarifaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepTarifaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepTarifaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepTarifaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepTarifaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addRepTarifa($obj1);
			} 
			
			$key3 = ConceptoPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = ConceptoPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = ConceptoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ConceptoPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addRepTarifa($obj1);
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
			RepTarifaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(RepTarifaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepTarifaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepTarifaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptConcepto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepTarifaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(RepTarifaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepTarifaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepTarifaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseRepTarifaPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseRepTarifaPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepTarifaPeer::addSelectColumns($c);
		$startcol2 = (RepTarifaPeer::NUM_COLUMNS - RepTarifaPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(RepTarifaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepTarifaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepTarifaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepTarifaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepTarifaPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = ConceptoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ConceptoPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ConceptoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ConceptoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepTarifa($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptConcepto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepTarifaPeer::addSelectColumns($c);
		$startcol2 = (RepTarifaPeer::NUM_COLUMNS - RepTarifaPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(RepTarifaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepTarifaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepTarifaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepTarifaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepTarifaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addRepTarifa($obj1);

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
		return RepTarifaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepTarifaPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRepTarifaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseRepTarifaPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseRepTarifaPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepTarifaPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRepTarifaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(RepTarifaPeer::OID);
			$selectCriteria->add(RepTarifaPeer::OID, $criteria->remove(RepTarifaPeer::OID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseRepTarifaPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseRepTarifaPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(RepTarifaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												RepTarifaPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof RepTarifa) {
						RepTarifaPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RepTarifaPeer::OID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								RepTarifaPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(RepTarifa $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RepTarifaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RepTarifaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RepTarifaPeer::DATABASE_NAME, RepTarifaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RepTarifaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = RepTarifaPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(RepTarifaPeer::DATABASE_NAME);
		$criteria->add(RepTarifaPeer::OID, $pk);

		$v = RepTarifaPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(RepTarifaPeer::DATABASE_NAME);
			$criteria->add(RepTarifaPeer::OID, $pks, Criteria::IN);
			$objs = RepTarifaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseRepTarifaPeer::DATABASE_NAME)->addTableBuilder(BaseRepTarifaPeer::TABLE_NAME, BaseRepTarifaPeer::getMapBuilder());

