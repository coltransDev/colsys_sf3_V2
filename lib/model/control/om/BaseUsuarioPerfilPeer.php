<?php


abstract class BaseUsuarioPerfilPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'control.tb_usuarios_perfil';

	
	const CLASS_DEFAULT = 'lib.model.control.UsuarioPerfil';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_LOGIN = 'control.tb_usuarios_perfil.CA_LOGIN';

	
	const CA_PERFIL = 'control.tb_usuarios_perfil.CA_PERFIL';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaLogin', 'CaPerfil', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caLogin', 'caPerfil', ),
		BasePeer::TYPE_COLNAME => array (self::CA_LOGIN, self::CA_PERFIL, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_login', 'ca_perfil', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaLogin' => 0, 'CaPerfil' => 1, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caLogin' => 0, 'caPerfil' => 1, ),
		BasePeer::TYPE_COLNAME => array (self::CA_LOGIN => 0, self::CA_PERFIL => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_login' => 0, 'ca_perfil' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new UsuarioPerfilMapBuilder();
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
		return str_replace(UsuarioPerfilPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(UsuarioPerfilPeer::CA_LOGIN);

		$criteria->addSelectColumn(UsuarioPerfilPeer::CA_PERFIL);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(UsuarioPerfilPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			UsuarioPerfilPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseUsuarioPerfilPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPerfilPeer', $criteria, $con);
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
		$objects = UsuarioPerfilPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return UsuarioPerfilPeer::populateObjects(UsuarioPerfilPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseUsuarioPerfilPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPerfilPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			UsuarioPerfilPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(UsuarioPerfil $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaLogin(), (string) $obj->getCaPerfil()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof UsuarioPerfil) {
				$key = serialize(array((string) $value->getCaLogin(), (string) $value->getCaPerfil()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or UsuarioPerfil object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = UsuarioPerfilPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = UsuarioPerfilPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = UsuarioPerfilPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				UsuarioPerfilPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinUsuario(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(UsuarioPerfilPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			UsuarioPerfilPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(UsuarioPerfilPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);


    foreach (sfMixer::getCallables('BaseUsuarioPerfilPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPerfilPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinPerfil(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(UsuarioPerfilPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			UsuarioPerfilPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(UsuarioPerfilPeer::CA_PERFIL,), array(PerfilPeer::CA_PERFIL,), $join_behavior);


    foreach (sfMixer::getCallables('BaseUsuarioPerfilPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPerfilPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinUsuario(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseUsuarioPerfilPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPerfilPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UsuarioPerfilPeer::addSelectColumns($c);
		$startcol = (UsuarioPerfilPeer::NUM_COLUMNS - UsuarioPerfilPeer::NUM_LAZY_LOAD_COLUMNS);
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(array(UsuarioPerfilPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = UsuarioPerfilPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = UsuarioPerfilPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = UsuarioPerfilPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				UsuarioPerfilPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addUsuarioPerfil($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinPerfil(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UsuarioPerfilPeer::addSelectColumns($c);
		$startcol = (UsuarioPerfilPeer::NUM_COLUMNS - UsuarioPerfilPeer::NUM_LAZY_LOAD_COLUMNS);
		PerfilPeer::addSelectColumns($c);

		$c->addJoin(array(UsuarioPerfilPeer::CA_PERFIL,), array(PerfilPeer::CA_PERFIL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = UsuarioPerfilPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = UsuarioPerfilPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = UsuarioPerfilPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				UsuarioPerfilPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = PerfilPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = PerfilPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = PerfilPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					PerfilPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addUsuarioPerfil($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(UsuarioPerfilPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			UsuarioPerfilPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(UsuarioPerfilPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$criteria->addJoin(array(UsuarioPerfilPeer::CA_PERFIL,), array(PerfilPeer::CA_PERFIL,), $join_behavior);

    foreach (sfMixer::getCallables('BaseUsuarioPerfilPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPerfilPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseUsuarioPerfilPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPerfilPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UsuarioPerfilPeer::addSelectColumns($c);
		$startcol2 = (UsuarioPerfilPeer::NUM_COLUMNS - UsuarioPerfilPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		PerfilPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (PerfilPeer::NUM_COLUMNS - PerfilPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(UsuarioPerfilPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$c->addJoin(array(UsuarioPerfilPeer::CA_PERFIL,), array(PerfilPeer::CA_PERFIL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = UsuarioPerfilPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = UsuarioPerfilPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = UsuarioPerfilPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				UsuarioPerfilPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addUsuarioPerfil($obj1);
			} 
			
			$key3 = PerfilPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = PerfilPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = PerfilPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					PerfilPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addUsuarioPerfil($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptUsuario(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			UsuarioPerfilPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(UsuarioPerfilPeer::CA_PERFIL,), array(PerfilPeer::CA_PERFIL,), $join_behavior);

    foreach (sfMixer::getCallables('BaseUsuarioPerfilPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPerfilPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptPerfil(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			UsuarioPerfilPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(UsuarioPerfilPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

    foreach (sfMixer::getCallables('BaseUsuarioPerfilPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPerfilPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptUsuario(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseUsuarioPerfilPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPerfilPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UsuarioPerfilPeer::addSelectColumns($c);
		$startcol2 = (UsuarioPerfilPeer::NUM_COLUMNS - UsuarioPerfilPeer::NUM_LAZY_LOAD_COLUMNS);

		PerfilPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PerfilPeer::NUM_COLUMNS - PerfilPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(UsuarioPerfilPeer::CA_PERFIL,), array(PerfilPeer::CA_PERFIL,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = UsuarioPerfilPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = UsuarioPerfilPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = UsuarioPerfilPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				UsuarioPerfilPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = PerfilPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = PerfilPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = PerfilPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					PerfilPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addUsuarioPerfil($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptPerfil(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UsuarioPerfilPeer::addSelectColumns($c);
		$startcol2 = (UsuarioPerfilPeer::NUM_COLUMNS - UsuarioPerfilPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(UsuarioPerfilPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = UsuarioPerfilPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = UsuarioPerfilPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = UsuarioPerfilPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				UsuarioPerfilPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addUsuarioPerfil($obj1);

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
		return UsuarioPerfilPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseUsuarioPerfilPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseUsuarioPerfilPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseUsuarioPerfilPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPerfilPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseUsuarioPerfilPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseUsuarioPerfilPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(UsuarioPerfilPeer::CA_LOGIN);
			$selectCriteria->add(UsuarioPerfilPeer::CA_LOGIN, $criteria->remove(UsuarioPerfilPeer::CA_LOGIN), $comparison);

			$comparison = $criteria->getComparison(UsuarioPerfilPeer::CA_PERFIL);
			$selectCriteria->add(UsuarioPerfilPeer::CA_PERFIL, $criteria->remove(UsuarioPerfilPeer::CA_PERFIL), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseUsuarioPerfilPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPerfilPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(UsuarioPerfilPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												UsuarioPerfilPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof UsuarioPerfil) {
						UsuarioPerfilPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(UsuarioPerfilPeer::CA_LOGIN, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(UsuarioPerfilPeer::CA_PERFIL, $value[1]));
				$criteria->addOr($criterion);

								UsuarioPerfilPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(UsuarioPerfil $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UsuarioPerfilPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UsuarioPerfilPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(UsuarioPerfilPeer::DATABASE_NAME, UsuarioPerfilPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = UsuarioPerfilPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_login, $ca_perfil, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_login, (string) $ca_perfil));
 		if (null !== ($obj = UsuarioPerfilPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(UsuarioPerfilPeer::DATABASE_NAME);
		$criteria->add(UsuarioPerfilPeer::CA_LOGIN, $ca_login);
		$criteria->add(UsuarioPerfilPeer::CA_PERFIL, $ca_perfil);
		$v = UsuarioPerfilPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseUsuarioPerfilPeer::DATABASE_NAME)->addTableBuilder(BaseUsuarioPerfilPeer::TABLE_NAME, BaseUsuarioPerfilPeer::getMapBuilder());

