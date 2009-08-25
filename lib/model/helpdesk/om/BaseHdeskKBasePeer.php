<?php


abstract class BaseHdeskKBasePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'helpdesk.tb_kbase';

	
	const CLASS_DEFAULT = 'lib.model.helpdesk.HdeskKBase';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDKBASE = 'helpdesk.tb_kbase.CA_IDKBASE';

	
	const CA_IDCATEGORY = 'helpdesk.tb_kbase.CA_IDCATEGORY';

	
	const CA_LOGIN = 'helpdesk.tb_kbase.CA_LOGIN';

	
	const CA_CREATEDAT = 'helpdesk.tb_kbase.CA_CREATEDAT';

	
	const CA_TEXT = 'helpdesk.tb_kbase.CA_TEXT';

	
	const CA_TITLE = 'helpdesk.tb_kbase.CA_TITLE';

	
	const CA_PRIVATE = 'helpdesk.tb_kbase.CA_PRIVATE';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdkbase', 'CaIdcategory', 'CaLogin', 'CaCreatedat', 'CaText', 'CaTitle', 'CaPrivate', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdkbase', 'caIdcategory', 'caLogin', 'caCreatedat', 'caText', 'caTitle', 'caPrivate', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDKBASE, self::CA_IDCATEGORY, self::CA_LOGIN, self::CA_CREATEDAT, self::CA_TEXT, self::CA_TITLE, self::CA_PRIVATE, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idkbase', 'ca_idcategory', 'ca_login', 'ca_createdat', 'ca_text', 'ca_title', 'ca_private', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdkbase' => 0, 'CaIdcategory' => 1, 'CaLogin' => 2, 'CaCreatedat' => 3, 'CaText' => 4, 'CaTitle' => 5, 'CaPrivate' => 6, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdkbase' => 0, 'caIdcategory' => 1, 'caLogin' => 2, 'caCreatedat' => 3, 'caText' => 4, 'caTitle' => 5, 'caPrivate' => 6, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDKBASE => 0, self::CA_IDCATEGORY => 1, self::CA_LOGIN => 2, self::CA_CREATEDAT => 3, self::CA_TEXT => 4, self::CA_TITLE => 5, self::CA_PRIVATE => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idkbase' => 0, 'ca_idcategory' => 1, 'ca_login' => 2, 'ca_createdat' => 3, 'ca_text' => 4, 'ca_title' => 5, 'ca_private' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new HdeskKBaseMapBuilder();
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
		return str_replace(HdeskKBasePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(HdeskKBasePeer::CA_IDKBASE);

		$criteria->addSelectColumn(HdeskKBasePeer::CA_IDCATEGORY);

		$criteria->addSelectColumn(HdeskKBasePeer::CA_LOGIN);

		$criteria->addSelectColumn(HdeskKBasePeer::CA_CREATEDAT);

		$criteria->addSelectColumn(HdeskKBasePeer::CA_TEXT);

		$criteria->addSelectColumn(HdeskKBasePeer::CA_TITLE);

		$criteria->addSelectColumn(HdeskKBasePeer::CA_PRIVATE);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HdeskKBasePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskKBasePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseHdeskKBasePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskKBasePeer', $criteria, $con);
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
		$objects = HdeskKBasePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return HdeskKBasePeer::populateObjects(HdeskKBasePeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskKBasePeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseHdeskKBasePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			HdeskKBasePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(HdeskKBase $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdkbase();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof HdeskKBase) {
				$key = (string) $value->getCaIdkbase();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or HdeskKBase object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = HdeskKBasePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = HdeskKBasePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = HdeskKBasePeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				HdeskKBasePeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinHdeskKBaseCategory(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HdeskKBasePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskKBasePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskKBasePeer::CA_IDCATEGORY,), array(HdeskKBaseCategoryPeer::CA_IDCATEGORY,), $join_behavior);


    foreach (sfMixer::getCallables('BaseHdeskKBasePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskKBasePeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(HdeskKBasePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskKBasePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskKBasePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);


    foreach (sfMixer::getCallables('BaseHdeskKBasePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskKBasePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinHdeskKBaseCategory(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseHdeskKBasePeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseHdeskKBasePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskKBasePeer::addSelectColumns($c);
		$startcol = (HdeskKBasePeer::NUM_COLUMNS - HdeskKBasePeer::NUM_LAZY_LOAD_COLUMNS);
		HdeskKBaseCategoryPeer::addSelectColumns($c);

		$c->addJoin(array(HdeskKBasePeer::CA_IDCATEGORY,), array(HdeskKBaseCategoryPeer::CA_IDCATEGORY,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskKBasePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskKBasePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HdeskKBasePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskKBasePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = HdeskKBaseCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = HdeskKBaseCategoryPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = HdeskKBaseCategoryPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					HdeskKBaseCategoryPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskKBase($obj1);

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

		HdeskKBasePeer::addSelectColumns($c);
		$startcol = (HdeskKBasePeer::NUM_COLUMNS - HdeskKBasePeer::NUM_LAZY_LOAD_COLUMNS);
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(array(HdeskKBasePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskKBasePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskKBasePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HdeskKBasePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskKBasePeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addHdeskKBase($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HdeskKBasePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskKBasePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskKBasePeer::CA_IDCATEGORY,), array(HdeskKBaseCategoryPeer::CA_IDCATEGORY,), $join_behavior);
		$criteria->addJoin(array(HdeskKBasePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

    foreach (sfMixer::getCallables('BaseHdeskKBasePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskKBasePeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseHdeskKBasePeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseHdeskKBasePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskKBasePeer::addSelectColumns($c);
		$startcol2 = (HdeskKBasePeer::NUM_COLUMNS - HdeskKBasePeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskKBaseCategoryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HdeskKBaseCategoryPeer::NUM_COLUMNS - HdeskKBaseCategoryPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(HdeskKBasePeer::CA_IDCATEGORY,), array(HdeskKBaseCategoryPeer::CA_IDCATEGORY,), $join_behavior);
		$c->addJoin(array(HdeskKBasePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskKBasePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskKBasePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HdeskKBasePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskKBasePeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = HdeskKBaseCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = HdeskKBaseCategoryPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = HdeskKBaseCategoryPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HdeskKBaseCategoryPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskKBase($obj1);
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
								$obj3->addHdeskKBase($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptHdeskKBaseCategory(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskKBasePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HdeskKBasePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

    foreach (sfMixer::getCallables('BaseHdeskKBasePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskKBasePeer', $criteria, $con);
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
			HdeskKBasePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HdeskKBasePeer::CA_IDCATEGORY,), array(HdeskKBaseCategoryPeer::CA_IDCATEGORY,), $join_behavior);

    foreach (sfMixer::getCallables('BaseHdeskKBasePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskKBasePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptHdeskKBaseCategory(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseHdeskKBasePeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseHdeskKBasePeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskKBasePeer::addSelectColumns($c);
		$startcol2 = (HdeskKBasePeer::NUM_COLUMNS - HdeskKBasePeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HdeskKBasePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskKBasePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskKBasePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HdeskKBasePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskKBasePeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addHdeskKBase($obj1);

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

		HdeskKBasePeer::addSelectColumns($c);
		$startcol2 = (HdeskKBasePeer::NUM_COLUMNS - HdeskKBasePeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskKBaseCategoryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HdeskKBaseCategoryPeer::NUM_COLUMNS - HdeskKBaseCategoryPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HdeskKBasePeer::CA_IDCATEGORY,), array(HdeskKBaseCategoryPeer::CA_IDCATEGORY,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskKBasePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskKBasePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HdeskKBasePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskKBasePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = HdeskKBaseCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = HdeskKBaseCategoryPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = HdeskKBaseCategoryPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HdeskKBaseCategoryPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskKBase($obj1);

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
		return HdeskKBasePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskKBasePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseHdeskKBasePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(HdeskKBasePeer::CA_IDKBASE) && $criteria->keyContainsValue(HdeskKBasePeer::CA_IDKBASE) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.HdeskKBasePeer::CA_IDKBASE.')');
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

		
    foreach (sfMixer::getCallables('BaseHdeskKBasePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseHdeskKBasePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskKBasePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseHdeskKBasePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(HdeskKBasePeer::CA_IDKBASE);
			$selectCriteria->add(HdeskKBasePeer::CA_IDKBASE, $criteria->remove(HdeskKBasePeer::CA_IDKBASE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseHdeskKBasePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseHdeskKBasePeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(HdeskKBasePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												HdeskKBasePeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof HdeskKBase) {
						HdeskKBasePeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(HdeskKBasePeer::CA_IDKBASE, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								HdeskKBasePeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(HdeskKBase $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(HdeskKBasePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(HdeskKBasePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(HdeskKBasePeer::DATABASE_NAME, HdeskKBasePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = HdeskKBasePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = HdeskKBasePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(HdeskKBasePeer::DATABASE_NAME);
		$criteria->add(HdeskKBasePeer::CA_IDKBASE, $pk);

		$v = HdeskKBasePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(HdeskKBasePeer::DATABASE_NAME);
			$criteria->add(HdeskKBasePeer::CA_IDKBASE, $pks, Criteria::IN);
			$objs = HdeskKBasePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseHdeskKBasePeer::DATABASE_NAME)->addTableBuilder(BaseHdeskKBasePeer::TABLE_NAME, BaseHdeskKBasePeer::getMapBuilder());

