<?php


abstract class BaseHdeskResponsePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'helpdesk.tb_responses';

	
	const CLASS_DEFAULT = 'lib.model.helpdesk.HdeskResponse';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDRESPONSE = 'helpdesk.tb_responses.CA_IDRESPONSE';

	
	const CA_IDTICKET = 'helpdesk.tb_responses.CA_IDTICKET';

	
	const CA_RESPONSETORESPONSE = 'helpdesk.tb_responses.CA_RESPONSETORESPONSE';

	
	const CA_LOGIN = 'helpdesk.tb_responses.CA_LOGIN';

	
	const CA_CREATEDAT = 'helpdesk.tb_responses.CA_CREATEDAT';

	
	const CA_TEXT = 'helpdesk.tb_responses.CA_TEXT';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdresponse', 'CaIdticket', 'CaResponsetoresponse', 'CaLogin', 'CaCreatedat', 'CaText', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdresponse', 'caIdticket', 'caResponsetoresponse', 'caLogin', 'caCreatedat', 'caText', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDRESPONSE, self::CA_IDTICKET, self::CA_RESPONSETORESPONSE, self::CA_LOGIN, self::CA_CREATEDAT, self::CA_TEXT, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idresponse', 'ca_idticket', 'ca_responsetoresponse', 'ca_login', 'ca_createdat', 'ca_text', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdresponse' => 0, 'CaIdticket' => 1, 'CaResponsetoresponse' => 2, 'CaLogin' => 3, 'CaCreatedat' => 4, 'CaText' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdresponse' => 0, 'caIdticket' => 1, 'caResponsetoresponse' => 2, 'caLogin' => 3, 'caCreatedat' => 4, 'caText' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDRESPONSE => 0, self::CA_IDTICKET => 1, self::CA_RESPONSETORESPONSE => 2, self::CA_LOGIN => 3, self::CA_CREATEDAT => 4, self::CA_TEXT => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idresponse' => 0, 'ca_idticket' => 1, 'ca_responsetoresponse' => 2, 'ca_login' => 3, 'ca_createdat' => 4, 'ca_text' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new HdeskResponseMapBuilder();
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
		return str_replace(HdeskResponsePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(HdeskResponsePeer::CA_IDRESPONSE);

		$criteria->addSelectColumn(HdeskResponsePeer::CA_IDTICKET);

		$criteria->addSelectColumn(HdeskResponsePeer::CA_RESPONSETORESPONSE);

		$criteria->addSelectColumn(HdeskResponsePeer::CA_LOGIN);

		$criteria->addSelectColumn(HdeskResponsePeer::CA_CREATEDAT);

		$criteria->addSelectColumn(HdeskResponsePeer::CA_TEXT);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HdeskResponsePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskResponsePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseHdeskResponsePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskResponsePeer', $criteria, $con);
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
		$objects = HdeskResponsePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return HdeskResponsePeer::populateObjects(HdeskResponsePeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskResponsePeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseHdeskResponsePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			HdeskResponsePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(HdeskResponse $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdresponse();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof HdeskResponse) {
				$key = (string) $value->getCaIdresponse();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or HdeskResponse object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = HdeskResponsePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = HdeskResponsePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = HdeskResponsePeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				HdeskResponsePeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinHdeskTicket(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HdeskResponsePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskResponsePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskResponsePeer::CA_IDTICKET,), array(HdeskTicketPeer::CA_IDTICKET,), $join_behavior);


    foreach (sfMixer::getCallables('BaseHdeskResponsePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskResponsePeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(HdeskResponsePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskResponsePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskResponsePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);


    foreach (sfMixer::getCallables('BaseHdeskResponsePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskResponsePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinHdeskTicket(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseHdeskResponsePeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseHdeskResponsePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskResponsePeer::addSelectColumns($c);
		$startcol = (HdeskResponsePeer::NUM_COLUMNS - HdeskResponsePeer::NUM_LAZY_LOAD_COLUMNS);
		HdeskTicketPeer::addSelectColumns($c);

		$c->addJoin(array(HdeskResponsePeer::CA_IDTICKET,), array(HdeskTicketPeer::CA_IDTICKET,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskResponsePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskResponsePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HdeskResponsePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskResponsePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = HdeskTicketPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = HdeskTicketPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					HdeskTicketPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskResponse($obj1);

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

		HdeskResponsePeer::addSelectColumns($c);
		$startcol = (HdeskResponsePeer::NUM_COLUMNS - HdeskResponsePeer::NUM_LAZY_LOAD_COLUMNS);
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(array(HdeskResponsePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskResponsePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskResponsePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HdeskResponsePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskResponsePeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addHdeskResponse($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HdeskResponsePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskResponsePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskResponsePeer::CA_IDTICKET,), array(HdeskTicketPeer::CA_IDTICKET,), $join_behavior);
		$criteria->addJoin(array(HdeskResponsePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

    foreach (sfMixer::getCallables('BaseHdeskResponsePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskResponsePeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseHdeskResponsePeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseHdeskResponsePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskResponsePeer::addSelectColumns($c);
		$startcol2 = (HdeskResponsePeer::NUM_COLUMNS - HdeskResponsePeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskTicketPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(HdeskResponsePeer::CA_IDTICKET,), array(HdeskTicketPeer::CA_IDTICKET,), $join_behavior);
		$c->addJoin(array(HdeskResponsePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskResponsePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskResponsePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HdeskResponsePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskResponsePeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = HdeskTicketPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = HdeskTicketPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HdeskTicketPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskResponse($obj1);
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
								$obj3->addHdeskResponse($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptHdeskTicket(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskResponsePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HdeskResponsePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

    foreach (sfMixer::getCallables('BaseHdeskResponsePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskResponsePeer', $criteria, $con);
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
			HdeskResponsePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HdeskResponsePeer::CA_IDTICKET,), array(HdeskTicketPeer::CA_IDTICKET,), $join_behavior);

    foreach (sfMixer::getCallables('BaseHdeskResponsePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskResponsePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptHdeskTicket(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseHdeskResponsePeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseHdeskResponsePeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskResponsePeer::addSelectColumns($c);
		$startcol2 = (HdeskResponsePeer::NUM_COLUMNS - HdeskResponsePeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HdeskResponsePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskResponsePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskResponsePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HdeskResponsePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskResponsePeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addHdeskResponse($obj1);

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

		HdeskResponsePeer::addSelectColumns($c);
		$startcol2 = (HdeskResponsePeer::NUM_COLUMNS - HdeskResponsePeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskTicketPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HdeskResponsePeer::CA_IDTICKET,), array(HdeskTicketPeer::CA_IDTICKET,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskResponsePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskResponsePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HdeskResponsePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskResponsePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = HdeskTicketPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = HdeskTicketPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HdeskTicketPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskResponse($obj1);

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
		return HdeskResponsePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskResponsePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseHdeskResponsePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(HdeskResponsePeer::CA_IDRESPONSE) && $criteria->keyContainsValue(HdeskResponsePeer::CA_IDRESPONSE) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.HdeskResponsePeer::CA_IDRESPONSE.')');
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

		
    foreach (sfMixer::getCallables('BaseHdeskResponsePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseHdeskResponsePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskResponsePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseHdeskResponsePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(HdeskResponsePeer::CA_IDRESPONSE);
			$selectCriteria->add(HdeskResponsePeer::CA_IDRESPONSE, $criteria->remove(HdeskResponsePeer::CA_IDRESPONSE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseHdeskResponsePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseHdeskResponsePeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(HdeskResponsePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												HdeskResponsePeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof HdeskResponse) {
						HdeskResponsePeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(HdeskResponsePeer::CA_IDRESPONSE, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								HdeskResponsePeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(HdeskResponse $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(HdeskResponsePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(HdeskResponsePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(HdeskResponsePeer::DATABASE_NAME, HdeskResponsePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = HdeskResponsePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = HdeskResponsePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(HdeskResponsePeer::DATABASE_NAME);
		$criteria->add(HdeskResponsePeer::CA_IDRESPONSE, $pk);

		$v = HdeskResponsePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(HdeskResponsePeer::DATABASE_NAME);
			$criteria->add(HdeskResponsePeer::CA_IDRESPONSE, $pks, Criteria::IN);
			$objs = HdeskResponsePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseHdeskResponsePeer::DATABASE_NAME)->addTableBuilder(BaseHdeskResponsePeer::TABLE_NAME, BaseHdeskResponsePeer::getMapBuilder());

