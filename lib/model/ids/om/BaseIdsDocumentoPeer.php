<?php


abstract class BaseIdsDocumentoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ids.tb_documentos';

	
	const CLASS_DEFAULT = 'lib.model.ids.IdsDocumento';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDDOCUMENTO = 'ids.tb_documentos.CA_IDDOCUMENTO';

	
	const CA_ID = 'ids.tb_documentos.CA_ID';

	
	const CA_IDTIPO = 'ids.tb_documentos.CA_IDTIPO';

	
	const CA_UBICACION = 'ids.tb_documentos.CA_UBICACION';

	
	const CA_FCHINICIO = 'ids.tb_documentos.CA_FCHINICIO';

	
	const CA_FCHVENCIMIENTO = 'ids.tb_documentos.CA_FCHVENCIMIENTO';

	
	const CA_OBSERVACIONES = 'ids.tb_documentos.CA_OBSERVACIONES';

	
	const CA_FCHCREADO = 'ids.tb_documentos.CA_FCHCREADO';

	
	const CA_USUCREADO = 'ids.tb_documentos.CA_USUCREADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddocumento', 'CaId', 'CaIdtipo', 'CaUbicacion', 'CaFchinicio', 'CaFchvencimiento', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIddocumento', 'caId', 'caIdtipo', 'caUbicacion', 'caFchinicio', 'caFchvencimiento', 'caObservaciones', 'caFchcreado', 'caUsucreado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDDOCUMENTO, self::CA_ID, self::CA_IDTIPO, self::CA_UBICACION, self::CA_FCHINICIO, self::CA_FCHVENCIMIENTO, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddocumento', 'ca_id', 'ca_idtipo', 'ca_ubicacion', 'ca_fchinicio', 'ca_fchvencimiento', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddocumento' => 0, 'CaId' => 1, 'CaIdtipo' => 2, 'CaUbicacion' => 3, 'CaFchinicio' => 4, 'CaFchvencimiento' => 5, 'CaObservaciones' => 6, 'CaFchcreado' => 7, 'CaUsucreado' => 8, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIddocumento' => 0, 'caId' => 1, 'caIdtipo' => 2, 'caUbicacion' => 3, 'caFchinicio' => 4, 'caFchvencimiento' => 5, 'caObservaciones' => 6, 'caFchcreado' => 7, 'caUsucreado' => 8, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDDOCUMENTO => 0, self::CA_ID => 1, self::CA_IDTIPO => 2, self::CA_UBICACION => 3, self::CA_FCHINICIO => 4, self::CA_FCHVENCIMIENTO => 5, self::CA_OBSERVACIONES => 6, self::CA_FCHCREADO => 7, self::CA_USUCREADO => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddocumento' => 0, 'ca_id' => 1, 'ca_idtipo' => 2, 'ca_ubicacion' => 3, 'ca_fchinicio' => 4, 'ca_fchvencimiento' => 5, 'ca_observaciones' => 6, 'ca_fchcreado' => 7, 'ca_usucreado' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new IdsDocumentoMapBuilder();
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
		return str_replace(IdsDocumentoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(IdsDocumentoPeer::CA_IDDOCUMENTO);

		$criteria->addSelectColumn(IdsDocumentoPeer::CA_ID);

		$criteria->addSelectColumn(IdsDocumentoPeer::CA_IDTIPO);

		$criteria->addSelectColumn(IdsDocumentoPeer::CA_UBICACION);

		$criteria->addSelectColumn(IdsDocumentoPeer::CA_FCHINICIO);

		$criteria->addSelectColumn(IdsDocumentoPeer::CA_FCHVENCIMIENTO);

		$criteria->addSelectColumn(IdsDocumentoPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(IdsDocumentoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(IdsDocumentoPeer::CA_USUCREADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsDocumentoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsDocumentoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseIdsDocumentoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsDocumentoPeer', $criteria, $con);
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
		$objects = IdsDocumentoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return IdsDocumentoPeer::populateObjects(IdsDocumentoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsDocumentoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseIdsDocumentoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			IdsDocumentoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(IdsDocumento $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIddocumento();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof IdsDocumento) {
				$key = (string) $value->getCaIddocumento();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or IdsDocumento object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = IdsDocumentoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = IdsDocumentoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = IdsDocumentoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				IdsDocumentoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinIds(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsDocumentoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsDocumentoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsDocumentoPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseIdsDocumentoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsDocumentoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinIdsTipoDocumento(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsDocumentoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsDocumentoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsDocumentoPeer::CA_IDTIPO,), array(IdsTipoDocumentoPeer::CA_IDTIPO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseIdsDocumentoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsDocumentoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinIds(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseIdsDocumentoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseIdsDocumentoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsDocumentoPeer::addSelectColumns($c);
		$startcol = (IdsDocumentoPeer::NUM_COLUMNS - IdsDocumentoPeer::NUM_LAZY_LOAD_COLUMNS);
		IdsPeer::addSelectColumns($c);

		$c->addJoin(array(IdsDocumentoPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsDocumentoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsDocumentoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = IdsDocumentoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsDocumentoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = IdsPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = IdsPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = IdsPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					IdsPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsDocumento($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinIdsTipoDocumento(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsDocumentoPeer::addSelectColumns($c);
		$startcol = (IdsDocumentoPeer::NUM_COLUMNS - IdsDocumentoPeer::NUM_LAZY_LOAD_COLUMNS);
		IdsTipoDocumentoPeer::addSelectColumns($c);

		$c->addJoin(array(IdsDocumentoPeer::CA_IDTIPO,), array(IdsTipoDocumentoPeer::CA_IDTIPO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsDocumentoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsDocumentoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = IdsDocumentoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsDocumentoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = IdsTipoDocumentoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = IdsTipoDocumentoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = IdsTipoDocumentoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					IdsTipoDocumentoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsDocumento($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsDocumentoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsDocumentoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsDocumentoPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);
		$criteria->addJoin(array(IdsDocumentoPeer::CA_IDTIPO,), array(IdsTipoDocumentoPeer::CA_IDTIPO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseIdsDocumentoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsDocumentoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseIdsDocumentoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseIdsDocumentoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsDocumentoPeer::addSelectColumns($c);
		$startcol2 = (IdsDocumentoPeer::NUM_COLUMNS - IdsDocumentoPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (IdsPeer::NUM_COLUMNS - IdsPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsTipoDocumentoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (IdsTipoDocumentoPeer::NUM_COLUMNS - IdsTipoDocumentoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(IdsDocumentoPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);
		$c->addJoin(array(IdsDocumentoPeer::CA_IDTIPO,), array(IdsTipoDocumentoPeer::CA_IDTIPO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsDocumentoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsDocumentoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = IdsDocumentoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsDocumentoPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = IdsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = IdsPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = IdsPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					IdsPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsDocumento($obj1);
			} 
			
			$key3 = IdsTipoDocumentoPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = IdsTipoDocumentoPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = IdsTipoDocumentoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					IdsTipoDocumentoPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addIdsDocumento($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptIds(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsDocumentoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(IdsDocumentoPeer::CA_IDTIPO,), array(IdsTipoDocumentoPeer::CA_IDTIPO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseIdsDocumentoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsDocumentoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptIdsTipoDocumento(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsDocumentoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(IdsDocumentoPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseIdsDocumentoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsDocumentoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptIds(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseIdsDocumentoPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseIdsDocumentoPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsDocumentoPeer::addSelectColumns($c);
		$startcol2 = (IdsDocumentoPeer::NUM_COLUMNS - IdsDocumentoPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsTipoDocumentoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (IdsTipoDocumentoPeer::NUM_COLUMNS - IdsTipoDocumentoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(IdsDocumentoPeer::CA_IDTIPO,), array(IdsTipoDocumentoPeer::CA_IDTIPO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsDocumentoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsDocumentoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = IdsDocumentoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsDocumentoPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = IdsTipoDocumentoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = IdsTipoDocumentoPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = IdsTipoDocumentoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					IdsTipoDocumentoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsDocumento($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptIdsTipoDocumento(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsDocumentoPeer::addSelectColumns($c);
		$startcol2 = (IdsDocumentoPeer::NUM_COLUMNS - IdsDocumentoPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (IdsPeer::NUM_COLUMNS - IdsPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(IdsDocumentoPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsDocumentoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsDocumentoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = IdsDocumentoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsDocumentoPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = IdsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = IdsPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = IdsPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					IdsPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsDocumento($obj1);

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
		return IdsDocumentoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsDocumentoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsDocumentoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(IdsDocumentoPeer::CA_IDDOCUMENTO) && $criteria->keyContainsValue(IdsDocumentoPeer::CA_IDDOCUMENTO) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.IdsDocumentoPeer::CA_IDDOCUMENTO.')');
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

		
    foreach (sfMixer::getCallables('BaseIdsDocumentoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsDocumentoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsDocumentoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsDocumentoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(IdsDocumentoPeer::CA_IDDOCUMENTO);
			$selectCriteria->add(IdsDocumentoPeer::CA_IDDOCUMENTO, $criteria->remove(IdsDocumentoPeer::CA_IDDOCUMENTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseIdsDocumentoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsDocumentoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(IdsDocumentoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												IdsDocumentoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof IdsDocumento) {
						IdsDocumentoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(IdsDocumentoPeer::CA_IDDOCUMENTO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								IdsDocumentoPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(IdsDocumento $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(IdsDocumentoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(IdsDocumentoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(IdsDocumentoPeer::DATABASE_NAME, IdsDocumentoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = IdsDocumentoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = IdsDocumentoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(IdsDocumentoPeer::DATABASE_NAME);
		$criteria->add(IdsDocumentoPeer::CA_IDDOCUMENTO, $pk);

		$v = IdsDocumentoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(IdsDocumentoPeer::DATABASE_NAME);
			$criteria->add(IdsDocumentoPeer::CA_IDDOCUMENTO, $pks, Criteria::IN);
			$objs = IdsDocumentoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseIdsDocumentoPeer::DATABASE_NAME)->addTableBuilder(BaseIdsDocumentoPeer::TABLE_NAME, BaseIdsDocumentoPeer::getMapBuilder());

