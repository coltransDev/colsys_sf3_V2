<?php


abstract class BaseRepStatusRespuestaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_repstatusrespuestas';

	
	const CLASS_DEFAULT = 'lib.model.reportes.RepStatusRespuesta';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDREPSTATUSRESPUESTAS = 'tb_repstatusrespuestas.CA_IDREPSTATUSRESPUESTAS';

	
	const CA_IDSTATUS = 'tb_repstatusrespuestas.CA_IDSTATUS';

	
	const CA_RESPUESTA = 'tb_repstatusrespuestas.CA_RESPUESTA';

	
	const CA_EMAIL = 'tb_repstatusrespuestas.CA_EMAIL';

	
	const CA_LOGIN = 'tb_repstatusrespuestas.CA_LOGIN';

	
	const CA_FCHCREADO = 'tb_repstatusrespuestas.CA_FCHCREADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdrepstatusrespuestas', 'CaIdstatus', 'CaRespuesta', 'CaEmail', 'CaLogin', 'CaFchcreado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdrepstatusrespuestas', 'caIdstatus', 'caRespuesta', 'caEmail', 'caLogin', 'caFchcreado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDREPSTATUSRESPUESTAS, self::CA_IDSTATUS, self::CA_RESPUESTA, self::CA_EMAIL, self::CA_LOGIN, self::CA_FCHCREADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idrepstatusrespuestas', 'ca_idstatus', 'ca_respuesta', 'ca_email', 'ca_login', 'ca_fchcreado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdrepstatusrespuestas' => 0, 'CaIdstatus' => 1, 'CaRespuesta' => 2, 'CaEmail' => 3, 'CaLogin' => 4, 'CaFchcreado' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdrepstatusrespuestas' => 0, 'caIdstatus' => 1, 'caRespuesta' => 2, 'caEmail' => 3, 'caLogin' => 4, 'caFchcreado' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDREPSTATUSRESPUESTAS => 0, self::CA_IDSTATUS => 1, self::CA_RESPUESTA => 2, self::CA_EMAIL => 3, self::CA_LOGIN => 4, self::CA_FCHCREADO => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idrepstatusrespuestas' => 0, 'ca_idstatus' => 1, 'ca_respuesta' => 2, 'ca_email' => 3, 'ca_login' => 4, 'ca_fchcreado' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new RepStatusRespuestaMapBuilder();
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
		return str_replace(RepStatusRespuestaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS);

		$criteria->addSelectColumn(RepStatusRespuestaPeer::CA_IDSTATUS);

		$criteria->addSelectColumn(RepStatusRespuestaPeer::CA_RESPUESTA);

		$criteria->addSelectColumn(RepStatusRespuestaPeer::CA_EMAIL);

		$criteria->addSelectColumn(RepStatusRespuestaPeer::CA_LOGIN);

		$criteria->addSelectColumn(RepStatusRespuestaPeer::CA_FCHCREADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepStatusRespuestaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepStatusRespuestaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseRepStatusRespuestaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusRespuestaPeer', $criteria, $con);
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
		$objects = RepStatusRespuestaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return RepStatusRespuestaPeer::populateObjects(RepStatusRespuestaPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepStatusRespuestaPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusRespuestaPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			RepStatusRespuestaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(RepStatusRespuesta $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdrepstatusrespuestas();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof RepStatusRespuesta) {
				$key = (string) $value->getCaIdrepstatusrespuestas();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or RepStatusRespuesta object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = RepStatusRespuestaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = RepStatusRespuestaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = RepStatusRespuestaPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				RepStatusRespuestaPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinRepStatus(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepStatusRespuestaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepStatusRespuestaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepStatusRespuestaPeer::CA_IDSTATUS,), array(RepStatusPeer::CA_IDSTATUS,), $join_behavior);


    foreach (sfMixer::getCallables('BaseRepStatusRespuestaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusRespuestaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinUsuario(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepStatusRespuestaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepStatusRespuestaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepStatusRespuestaPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);


    foreach (sfMixer::getCallables('BaseRepStatusRespuestaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusRespuestaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinRepStatus(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseRepStatusRespuestaPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusRespuestaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepStatusRespuestaPeer::addSelectColumns($c);
		$startcol = (RepStatusRespuestaPeer::NUM_COLUMNS - RepStatusRespuestaPeer::NUM_LAZY_LOAD_COLUMNS);
		RepStatusPeer::addSelectColumns($c);

		$c->addJoin(array(RepStatusRespuestaPeer::CA_IDSTATUS,), array(RepStatusPeer::CA_IDSTATUS,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepStatusRespuestaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepStatusRespuestaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = RepStatusRespuestaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepStatusRespuestaPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = RepStatusPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = RepStatusPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = RepStatusPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					RepStatusPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepStatusRespuesta($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinUsuario(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepStatusRespuestaPeer::addSelectColumns($c);
		$startcol = (RepStatusRespuestaPeer::NUM_COLUMNS - RepStatusRespuestaPeer::NUM_LAZY_LOAD_COLUMNS);
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(array(RepStatusRespuestaPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepStatusRespuestaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepStatusRespuestaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = RepStatusRespuestaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepStatusRespuestaPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = UsuarioPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = UsuarioPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepStatusRespuesta($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepStatusRespuestaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepStatusRespuestaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepStatusRespuestaPeer::CA_IDSTATUS,), array(RepStatusPeer::CA_IDSTATUS,), $join_behavior);
		$criteria->addJoin(array(RepStatusRespuestaPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepStatusRespuestaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusRespuestaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseRepStatusRespuestaPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusRespuestaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepStatusRespuestaPeer::addSelectColumns($c);
		$startcol2 = (RepStatusRespuestaPeer::NUM_COLUMNS - RepStatusRespuestaPeer::NUM_LAZY_LOAD_COLUMNS);

		RepStatusPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(RepStatusRespuestaPeer::CA_IDSTATUS,), array(RepStatusPeer::CA_IDSTATUS,), $join_behavior);
		$c->addJoin(array(RepStatusRespuestaPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepStatusRespuestaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepStatusRespuestaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepStatusRespuestaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepStatusRespuestaPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = RepStatusPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = RepStatusPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = RepStatusPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					RepStatusPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepStatusRespuesta($obj1);
			} 
			
			$key3 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = UsuarioPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					UsuarioPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addRepStatusRespuesta($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptRepStatus(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepStatusRespuestaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(RepStatusRespuestaPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepStatusRespuestaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusRespuestaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptUsuario(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepStatusRespuestaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(RepStatusRespuestaPeer::CA_IDSTATUS,), array(RepStatusPeer::CA_IDSTATUS,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepStatusRespuestaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusRespuestaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptRepStatus(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseRepStatusRespuestaPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusRespuestaPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepStatusRespuestaPeer::addSelectColumns($c);
		$startcol2 = (RepStatusRespuestaPeer::NUM_COLUMNS - RepStatusRespuestaPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(RepStatusRespuestaPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepStatusRespuestaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepStatusRespuestaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepStatusRespuestaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepStatusRespuestaPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UsuarioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepStatusRespuesta($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptUsuario(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepStatusRespuestaPeer::addSelectColumns($c);
		$startcol2 = (RepStatusRespuestaPeer::NUM_COLUMNS - RepStatusRespuestaPeer::NUM_LAZY_LOAD_COLUMNS);

		RepStatusPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(RepStatusRespuestaPeer::CA_IDSTATUS,), array(RepStatusPeer::CA_IDSTATUS,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepStatusRespuestaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepStatusRespuestaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepStatusRespuestaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepStatusRespuestaPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = RepStatusPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = RepStatusPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = RepStatusPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					RepStatusPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepStatusRespuesta($obj1);

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
		return RepStatusRespuestaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepStatusRespuestaPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRepStatusRespuestaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS) && $criteria->keyContainsValue(RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS.')');
		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseRepStatusRespuestaPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusRespuestaPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepStatusRespuestaPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRepStatusRespuestaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS);
			$selectCriteria->add(RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS, $criteria->remove(RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseRepStatusRespuestaPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusRespuestaPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(RepStatusRespuestaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												RepStatusRespuestaPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof RepStatusRespuesta) {
						RepStatusRespuestaPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								RepStatusRespuestaPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(RepStatusRespuesta $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RepStatusRespuestaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RepStatusRespuestaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RepStatusRespuestaPeer::DATABASE_NAME, RepStatusRespuestaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RepStatusRespuestaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = RepStatusRespuestaPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(RepStatusRespuestaPeer::DATABASE_NAME);
		$criteria->add(RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS, $pk);

		$v = RepStatusRespuestaPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(RepStatusRespuestaPeer::DATABASE_NAME);
			$criteria->add(RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS, $pks, Criteria::IN);
			$objs = RepStatusRespuestaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseRepStatusRespuestaPeer::DATABASE_NAME)->addTableBuilder(BaseRepStatusRespuestaPeer::TABLE_NAME, BaseRepStatusRespuestaPeer::getMapBuilder());

