<?php


abstract class BaseHdeskTicketPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'helpdesk.tb_tickets';

	
	const CLASS_DEFAULT = 'lib.model.helpdesk.HdeskTicket';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDTICKET = 'helpdesk.tb_tickets.CA_IDTICKET';

	
	const CA_IDGROUP = 'helpdesk.tb_tickets.CA_IDGROUP';

	
	const CA_IDPROJECT = 'helpdesk.tb_tickets.CA_IDPROJECT';

	
	const CA_LOGIN = 'helpdesk.tb_tickets.CA_LOGIN';

	
	const CA_TITLE = 'helpdesk.tb_tickets.CA_TITLE';

	
	const CA_TEXT = 'helpdesk.tb_tickets.CA_TEXT';

	
	const CA_PRIORITY = 'helpdesk.tb_tickets.CA_PRIORITY';

	
	const CA_OPENED = 'helpdesk.tb_tickets.CA_OPENED';

	
	const CA_TYPE = 'helpdesk.tb_tickets.CA_TYPE';

	
	const CA_ASSIGNEDTO = 'helpdesk.tb_tickets.CA_ASSIGNEDTO';

	
	const CA_ACTION = 'helpdesk.tb_tickets.CA_ACTION';

	
	const CA_IDTAREA = 'helpdesk.tb_tickets.CA_IDTAREA';

	
	const CA_IDSEGUIMIENTO = 'helpdesk.tb_tickets.CA_IDSEGUIMIENTO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdticket', 'CaIdgroup', 'CaIdproject', 'CaLogin', 'CaTitle', 'CaText', 'CaPriority', 'CaOpened', 'CaType', 'CaAssignedto', 'CaAction', 'CaIdtarea', 'CaIdseguimiento', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdticket', 'caIdgroup', 'caIdproject', 'caLogin', 'caTitle', 'caText', 'caPriority', 'caOpened', 'caType', 'caAssignedto', 'caAction', 'caIdtarea', 'caIdseguimiento', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTICKET, self::CA_IDGROUP, self::CA_IDPROJECT, self::CA_LOGIN, self::CA_TITLE, self::CA_TEXT, self::CA_PRIORITY, self::CA_OPENED, self::CA_TYPE, self::CA_ASSIGNEDTO, self::CA_ACTION, self::CA_IDTAREA, self::CA_IDSEGUIMIENTO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idticket', 'ca_idgroup', 'ca_idproject', 'ca_login', 'ca_title', 'ca_text', 'ca_priority', 'ca_opened', 'ca_type', 'ca_assignedto', 'ca_action', 'ca_idtarea', 'ca_idseguimiento', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdticket' => 0, 'CaIdgroup' => 1, 'CaIdproject' => 2, 'CaLogin' => 3, 'CaTitle' => 4, 'CaText' => 5, 'CaPriority' => 6, 'CaOpened' => 7, 'CaType' => 8, 'CaAssignedto' => 9, 'CaAction' => 10, 'CaIdtarea' => 11, 'CaIdseguimiento' => 12, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdticket' => 0, 'caIdgroup' => 1, 'caIdproject' => 2, 'caLogin' => 3, 'caTitle' => 4, 'caText' => 5, 'caPriority' => 6, 'caOpened' => 7, 'caType' => 8, 'caAssignedto' => 9, 'caAction' => 10, 'caIdtarea' => 11, 'caIdseguimiento' => 12, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTICKET => 0, self::CA_IDGROUP => 1, self::CA_IDPROJECT => 2, self::CA_LOGIN => 3, self::CA_TITLE => 4, self::CA_TEXT => 5, self::CA_PRIORITY => 6, self::CA_OPENED => 7, self::CA_TYPE => 8, self::CA_ASSIGNEDTO => 9, self::CA_ACTION => 10, self::CA_IDTAREA => 11, self::CA_IDSEGUIMIENTO => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idticket' => 0, 'ca_idgroup' => 1, 'ca_idproject' => 2, 'ca_login' => 3, 'ca_title' => 4, 'ca_text' => 5, 'ca_priority' => 6, 'ca_opened' => 7, 'ca_type' => 8, 'ca_assignedto' => 9, 'ca_action' => 10, 'ca_idtarea' => 11, 'ca_idseguimiento' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new HdeskTicketMapBuilder();
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
		return str_replace(HdeskTicketPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(HdeskTicketPeer::CA_IDTICKET);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_IDGROUP);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_IDPROJECT);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_LOGIN);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_TITLE);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_TEXT);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_PRIORITY);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_OPENED);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_TYPE);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_ASSIGNEDTO);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_ACTION);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_IDTAREA);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_IDSEGUIMIENTO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HdeskTicketPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $criteria, $con);
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
		$objects = HdeskTicketPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return HdeskTicketPeer::populateObjects(HdeskTicketPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			HdeskTicketPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(HdeskTicket $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdticket();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof HdeskTicket) {
				$key = (string) $value->getCaIdticket();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or HdeskTicket object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = HdeskTicketPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = HdeskTicketPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				HdeskTicketPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinHdeskGroup(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HdeskTicketPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);


    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(HdeskTicketPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);


    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinHdeskProject(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HdeskTicketPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);


    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinNotTarea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HdeskTicketPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinHdeskGroup(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);
		HdeskGroupPeer::addSelectColumns($c);

		$c->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = HdeskGroupPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = HdeskGroupPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = HdeskGroupPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					HdeskGroupPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskTicket($obj1);

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

		HdeskTicketPeer::addSelectColumns($c);
		$startcol = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addHdeskTicket($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinHdeskProject(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);
		HdeskProjectPeer::addSelectColumns($c);

		$c->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = HdeskProjectPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = HdeskProjectPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = HdeskProjectPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					HdeskProjectPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskTicket($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinNotTarea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);
		NotTareaPeer::addSelectColumns($c);

		$c->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = NotTareaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = NotTareaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					NotTareaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskTicket($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HdeskTicketPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
		$criteria->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$criteria->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
		$criteria->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol2 = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HdeskGroupPeer::NUM_COLUMNS - HdeskGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskProjectPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (HdeskProjectPeer::NUM_COLUMNS - HdeskProjectPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
		$c->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$c->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
		$c->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = HdeskGroupPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = HdeskGroupPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = HdeskGroupPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HdeskGroupPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskTicket($obj1);
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
								$obj3->addHdeskTicket($obj1);
			} 
			
			$key4 = HdeskProjectPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = HdeskProjectPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = HdeskProjectPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					HdeskProjectPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addHdeskTicket($obj1);
			} 
			
			$key5 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol5);
			if ($key5 !== null) {
				$obj5 = NotTareaPeer::getInstanceFromPool($key5);
				if (!$obj5) {

					$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					NotTareaPeer::addInstanceToPool($obj5, $key5);
				} 
								$obj5->addHdeskTicket($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptHdeskGroup(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $criteria, $con);
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
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptHdeskProject(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptNotTarea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);

    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptHdeskGroup(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol2 = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskProjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (HdeskProjectPeer::NUM_COLUMNS - HdeskProjectPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addHdeskTicket($obj1);

			} 
				
				$key3 = HdeskProjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = HdeskProjectPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = HdeskProjectPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					HdeskProjectPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addHdeskTicket($obj1);

			} 
				
				$key4 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = NotTareaPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					NotTareaPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addHdeskTicket($obj1);

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

		HdeskTicketPeer::addSelectColumns($c);
		$startcol2 = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HdeskGroupPeer::NUM_COLUMNS - HdeskGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskProjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (HdeskProjectPeer::NUM_COLUMNS - HdeskProjectPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = HdeskGroupPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = HdeskGroupPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = HdeskGroupPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HdeskGroupPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskTicket($obj1);

			} 
				
				$key3 = HdeskProjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = HdeskProjectPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = HdeskProjectPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					HdeskProjectPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addHdeskTicket($obj1);

			} 
				
				$key4 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = NotTareaPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					NotTareaPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addHdeskTicket($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptHdeskProject(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol2 = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HdeskGroupPeer::NUM_COLUMNS - HdeskGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = HdeskGroupPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = HdeskGroupPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = HdeskGroupPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HdeskGroupPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskTicket($obj1);

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
								$obj3->addHdeskTicket($obj1);

			} 
				
				$key4 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = NotTareaPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					NotTareaPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addHdeskTicket($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptNotTarea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol2 = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HdeskGroupPeer::NUM_COLUMNS - HdeskGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskProjectPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (HdeskProjectPeer::NUM_COLUMNS - HdeskProjectPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = HdeskGroupPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = HdeskGroupPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = HdeskGroupPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HdeskGroupPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskTicket($obj1);

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
								$obj3->addHdeskTicket($obj1);

			} 
				
				$key4 = HdeskProjectPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = HdeskProjectPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = HdeskProjectPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					HdeskProjectPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addHdeskTicket($obj1);

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
		return HdeskTicketPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseHdeskTicketPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(HdeskTicketPeer::CA_IDTICKET) && $criteria->keyContainsValue(HdeskTicketPeer::CA_IDTICKET) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.HdeskTicketPeer::CA_IDTICKET.')');
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

		
    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseHdeskTicketPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(HdeskTicketPeer::CA_IDTICKET);
			$selectCriteria->add(HdeskTicketPeer::CA_IDTICKET, $criteria->remove(HdeskTicketPeer::CA_IDTICKET), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseHdeskTicketPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseHdeskTicketPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(HdeskTicketPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												HdeskTicketPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof HdeskTicket) {
						HdeskTicketPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(HdeskTicketPeer::CA_IDTICKET, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								HdeskTicketPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(HdeskTicket $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(HdeskTicketPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(HdeskTicketPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(HdeskTicketPeer::DATABASE_NAME, HdeskTicketPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = HdeskTicketPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = HdeskTicketPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(HdeskTicketPeer::DATABASE_NAME);
		$criteria->add(HdeskTicketPeer::CA_IDTICKET, $pk);

		$v = HdeskTicketPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(HdeskTicketPeer::DATABASE_NAME);
			$criteria->add(HdeskTicketPeer::CA_IDTICKET, $pks, Criteria::IN);
			$objs = HdeskTicketPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseHdeskTicketPeer::DATABASE_NAME)->addTableBuilder(BaseHdeskTicketPeer::TABLE_NAME, BaseHdeskTicketPeer::getMapBuilder());

