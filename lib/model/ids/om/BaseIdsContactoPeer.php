<?php


abstract class BaseIdsContactoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ids.tb_contactos';

	
	const CLASS_DEFAULT = 'lib.model.ids.IdsContacto';

	
	const NUM_COLUMNS = 23;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDCONTACTO = 'ids.tb_contactos.CA_IDCONTACTO';

	
	const CA_IDSUCURSAL = 'ids.tb_contactos.CA_IDSUCURSAL';

	
	const CA_NOMBRES = 'ids.tb_contactos.CA_NOMBRES';

	
	const CA_PAPELLIDO = 'ids.tb_contactos.CA_PAPELLIDO';

	
	const CA_SAPELLIDO = 'ids.tb_contactos.CA_SAPELLIDO';

	
	const CA_SALUDO = 'ids.tb_contactos.CA_SALUDO';

	
	const CA_DIRECCION = 'ids.tb_contactos.CA_DIRECCION';

	
	const CA_TELEFONOS = 'ids.tb_contactos.CA_TELEFONOS';

	
	const CA_FAX = 'ids.tb_contactos.CA_FAX';

	
	const CA_EMAIL = 'ids.tb_contactos.CA_EMAIL';

	
	const CA_IMPOEXPO = 'ids.tb_contactos.CA_IMPOEXPO';

	
	const CA_TRANSPORTE = 'ids.tb_contactos.CA_TRANSPORTE';

	
	const CA_CARGO = 'ids.tb_contactos.CA_CARGO';

	
	const CA_DEPARTAMENTO = 'ids.tb_contactos.CA_DEPARTAMENTO';

	
	const CA_OBSERVACIONES = 'ids.tb_contactos.CA_OBSERVACIONES';

	
	const CA_SUGERIDO = 'ids.tb_contactos.CA_SUGERIDO';

	
	const CA_ACTIVO = 'ids.tb_contactos.CA_ACTIVO';

	
	const CA_FCHCREADO = 'ids.tb_contactos.CA_FCHCREADO';

	
	const CA_USUCREADO = 'ids.tb_contactos.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'ids.tb_contactos.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'ids.tb_contactos.CA_USUACTUALIZADO';

	
	const CA_FCHELIMINADO = 'ids.tb_contactos.CA_FCHELIMINADO';

	
	const CA_USUELIMINADO = 'ids.tb_contactos.CA_USUELIMINADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcontacto', 'CaIdsucursal', 'CaNombres', 'CaPapellido', 'CaSapellido', 'CaSaludo', 'CaDireccion', 'CaTelefonos', 'CaFax', 'CaEmail', 'CaImpoexpo', 'CaTransporte', 'CaCargo', 'CaDepartamento', 'CaObservaciones', 'CaSugerido', 'CaActivo', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFcheliminado', 'CaUsueliminado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcontacto', 'caIdsucursal', 'caNombres', 'caPapellido', 'caSapellido', 'caSaludo', 'caDireccion', 'caTelefonos', 'caFax', 'caEmail', 'caImpoexpo', 'caTransporte', 'caCargo', 'caDepartamento', 'caObservaciones', 'caSugerido', 'caActivo', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caFcheliminado', 'caUsueliminado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCONTACTO, self::CA_IDSUCURSAL, self::CA_NOMBRES, self::CA_PAPELLIDO, self::CA_SAPELLIDO, self::CA_SALUDO, self::CA_DIRECCION, self::CA_TELEFONOS, self::CA_FAX, self::CA_EMAIL, self::CA_IMPOEXPO, self::CA_TRANSPORTE, self::CA_CARGO, self::CA_DEPARTAMENTO, self::CA_OBSERVACIONES, self::CA_SUGERIDO, self::CA_ACTIVO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_FCHELIMINADO, self::CA_USUELIMINADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcontacto', 'ca_idsucursal', 'ca_nombres', 'ca_papellido', 'ca_sapellido', 'ca_saludo', 'ca_direccion', 'ca_telefonos', 'ca_fax', 'ca_email', 'ca_impoexpo', 'ca_transporte', 'ca_cargo', 'ca_departamento', 'ca_observaciones', 'ca_sugerido', 'ca_activo', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fcheliminado', 'ca_usueliminado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcontacto' => 0, 'CaIdsucursal' => 1, 'CaNombres' => 2, 'CaPapellido' => 3, 'CaSapellido' => 4, 'CaSaludo' => 5, 'CaDireccion' => 6, 'CaTelefonos' => 7, 'CaFax' => 8, 'CaEmail' => 9, 'CaImpoexpo' => 10, 'CaTransporte' => 11, 'CaCargo' => 12, 'CaDepartamento' => 13, 'CaObservaciones' => 14, 'CaSugerido' => 15, 'CaActivo' => 16, 'CaFchcreado' => 17, 'CaUsucreado' => 18, 'CaFchactualizado' => 19, 'CaUsuactualizado' => 20, 'CaFcheliminado' => 21, 'CaUsueliminado' => 22, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcontacto' => 0, 'caIdsucursal' => 1, 'caNombres' => 2, 'caPapellido' => 3, 'caSapellido' => 4, 'caSaludo' => 5, 'caDireccion' => 6, 'caTelefonos' => 7, 'caFax' => 8, 'caEmail' => 9, 'caImpoexpo' => 10, 'caTransporte' => 11, 'caCargo' => 12, 'caDepartamento' => 13, 'caObservaciones' => 14, 'caSugerido' => 15, 'caActivo' => 16, 'caFchcreado' => 17, 'caUsucreado' => 18, 'caFchactualizado' => 19, 'caUsuactualizado' => 20, 'caFcheliminado' => 21, 'caUsueliminado' => 22, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCONTACTO => 0, self::CA_IDSUCURSAL => 1, self::CA_NOMBRES => 2, self::CA_PAPELLIDO => 3, self::CA_SAPELLIDO => 4, self::CA_SALUDO => 5, self::CA_DIRECCION => 6, self::CA_TELEFONOS => 7, self::CA_FAX => 8, self::CA_EMAIL => 9, self::CA_IMPOEXPO => 10, self::CA_TRANSPORTE => 11, self::CA_CARGO => 12, self::CA_DEPARTAMENTO => 13, self::CA_OBSERVACIONES => 14, self::CA_SUGERIDO => 15, self::CA_ACTIVO => 16, self::CA_FCHCREADO => 17, self::CA_USUCREADO => 18, self::CA_FCHACTUALIZADO => 19, self::CA_USUACTUALIZADO => 20, self::CA_FCHELIMINADO => 21, self::CA_USUELIMINADO => 22, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcontacto' => 0, 'ca_idsucursal' => 1, 'ca_nombres' => 2, 'ca_papellido' => 3, 'ca_sapellido' => 4, 'ca_saludo' => 5, 'ca_direccion' => 6, 'ca_telefonos' => 7, 'ca_fax' => 8, 'ca_email' => 9, 'ca_impoexpo' => 10, 'ca_transporte' => 11, 'ca_cargo' => 12, 'ca_departamento' => 13, 'ca_observaciones' => 14, 'ca_sugerido' => 15, 'ca_activo' => 16, 'ca_fchcreado' => 17, 'ca_usucreado' => 18, 'ca_fchactualizado' => 19, 'ca_usuactualizado' => 20, 'ca_fcheliminado' => 21, 'ca_usueliminado' => 22, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new IdsContactoMapBuilder();
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
		return str_replace(IdsContactoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(IdsContactoPeer::CA_IDCONTACTO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_IDSUCURSAL);

		$criteria->addSelectColumn(IdsContactoPeer::CA_NOMBRES);

		$criteria->addSelectColumn(IdsContactoPeer::CA_PAPELLIDO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_SAPELLIDO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_SALUDO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_DIRECCION);

		$criteria->addSelectColumn(IdsContactoPeer::CA_TELEFONOS);

		$criteria->addSelectColumn(IdsContactoPeer::CA_FAX);

		$criteria->addSelectColumn(IdsContactoPeer::CA_EMAIL);

		$criteria->addSelectColumn(IdsContactoPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(IdsContactoPeer::CA_CARGO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_DEPARTAMENTO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(IdsContactoPeer::CA_SUGERIDO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_ACTIVO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_USUCREADO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_FCHELIMINADO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_USUELIMINADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsContactoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseIdsContactoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsContactoPeer', $criteria, $con);
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
		$objects = IdsContactoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return IdsContactoPeer::populateObjects(IdsContactoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsContactoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseIdsContactoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			IdsContactoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(IdsContacto $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdcontacto();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof IdsContacto) {
				$key = (string) $value->getCaIdcontacto();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or IdsContacto object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = IdsContactoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = IdsContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = IdsContactoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				IdsContactoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinIdsSucursal(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsContactoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsContactoPeer::CA_IDSUCURSAL,), array(IdsSucursalPeer::CA_IDSUCURSAL,), $join_behavior);


    foreach (sfMixer::getCallables('BaseIdsContactoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsContactoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinIdsSucursal(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseIdsContactoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseIdsContactoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsContactoPeer::addSelectColumns($c);
		$startcol = (IdsContactoPeer::NUM_COLUMNS - IdsContactoPeer::NUM_LAZY_LOAD_COLUMNS);
		IdsSucursalPeer::addSelectColumns($c);

		$c->addJoin(array(IdsContactoPeer::CA_IDSUCURSAL,), array(IdsSucursalPeer::CA_IDSUCURSAL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsContactoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = IdsContactoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsContactoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = IdsSucursalPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = IdsSucursalPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = IdsSucursalPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					IdsSucursalPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsContacto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsContactoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsContactoPeer::CA_IDSUCURSAL,), array(IdsSucursalPeer::CA_IDSUCURSAL,), $join_behavior);

    foreach (sfMixer::getCallables('BaseIdsContactoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsContactoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseIdsContactoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseIdsContactoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsContactoPeer::addSelectColumns($c);
		$startcol2 = (IdsContactoPeer::NUM_COLUMNS - IdsContactoPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsSucursalPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (IdsSucursalPeer::NUM_COLUMNS - IdsSucursalPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(IdsContactoPeer::CA_IDSUCURSAL,), array(IdsSucursalPeer::CA_IDSUCURSAL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsContactoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = IdsContactoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsContactoPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = IdsSucursalPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = IdsSucursalPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = IdsSucursalPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					IdsSucursalPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsContacto($obj1);
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
		return IdsContactoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsContactoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsContactoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseIdsContactoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsContactoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsContactoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsContactoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(IdsContactoPeer::CA_IDCONTACTO);
			$selectCriteria->add(IdsContactoPeer::CA_IDCONTACTO, $criteria->remove(IdsContactoPeer::CA_IDCONTACTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseIdsContactoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsContactoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(IdsContactoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												IdsContactoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof IdsContacto) {
						IdsContactoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(IdsContactoPeer::CA_IDCONTACTO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								IdsContactoPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(IdsContacto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(IdsContactoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(IdsContactoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(IdsContactoPeer::DATABASE_NAME, IdsContactoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = IdsContactoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = IdsContactoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(IdsContactoPeer::DATABASE_NAME);
		$criteria->add(IdsContactoPeer::CA_IDCONTACTO, $pk);

		$v = IdsContactoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(IdsContactoPeer::DATABASE_NAME);
			$criteria->add(IdsContactoPeer::CA_IDCONTACTO, $pks, Criteria::IN);
			$objs = IdsContactoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseIdsContactoPeer::DATABASE_NAME)->addTableBuilder(BaseIdsContactoPeer::TABLE_NAME, BaseIdsContactoPeer::getMapBuilder());

