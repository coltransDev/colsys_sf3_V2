<?php


abstract class BaseCotizacionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_cotizaciones';

	
	const CLASS_DEFAULT = 'lib.model.cotizaciones.Cotizacion';

	
	const NUM_COLUMNS = 22;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDCOTIZACION = 'tb_cotizaciones.CA_IDCOTIZACION';

	
	const CA_IDCONTACTO = 'tb_cotizaciones.CA_IDCONTACTO';

	
	const CA_CONSECUTIVO = 'tb_cotizaciones.CA_CONSECUTIVO';

	
	const CA_ASUNTO = 'tb_cotizaciones.CA_ASUNTO';

	
	const CA_SALUDO = 'tb_cotizaciones.CA_SALUDO';

	
	const CA_ENTRADA = 'tb_cotizaciones.CA_ENTRADA';

	
	const CA_DESPEDIDA = 'tb_cotizaciones.CA_DESPEDIDA';

	
	const CA_USUARIO = 'tb_cotizaciones.CA_USUARIO';

	
	const CA_ANEXOS = 'tb_cotizaciones.CA_ANEXOS';

	
	const CA_FCHCREADO = 'tb_cotizaciones.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_cotizaciones.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_cotizaciones.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_cotizaciones.CA_USUACTUALIZADO';

	
	const CA_FCHSOLICITUD = 'tb_cotizaciones.CA_FCHSOLICITUD';

	
	const CA_HORASOLICITUD = 'tb_cotizaciones.CA_HORASOLICITUD';

	
	const CA_FCHPRESENTACION = 'tb_cotizaciones.CA_FCHPRESENTACION';

	
	const CA_FCHANULADO = 'tb_cotizaciones.CA_FCHANULADO';

	
	const CA_USUANULADO = 'tb_cotizaciones.CA_USUANULADO';

	
	const CA_EMPRESA = 'tb_cotizaciones.CA_EMPRESA';

	
	const CA_DATOSAG = 'tb_cotizaciones.CA_DATOSAG';

	
	const CA_FUENTE = 'tb_cotizaciones.CA_FUENTE';

	
	const CA_IDG_ENVIO_OPORTUNO = 'tb_cotizaciones.CA_IDG_ENVIO_OPORTUNO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion', 'CaIdcontacto', 'CaConsecutivo', 'CaAsunto', 'CaSaludo', 'CaEntrada', 'CaDespedida', 'CaUsuario', 'CaAnexos', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchsolicitud', 'CaHorasolicitud', 'CaFchpresentacion', 'CaFchanulado', 'CaUsuanulado', 'CaEmpresa', 'CaDatosag', 'CaFuente', 'CaIdgEnvioOportuno', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcotizacion', 'caIdcontacto', 'caConsecutivo', 'caAsunto', 'caSaludo', 'caEntrada', 'caDespedida', 'caUsuario', 'caAnexos', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caFchsolicitud', 'caHorasolicitud', 'caFchpresentacion', 'caFchanulado', 'caUsuanulado', 'caEmpresa', 'caDatosag', 'caFuente', 'caIdgEnvioOportuno', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCOTIZACION, self::CA_IDCONTACTO, self::CA_CONSECUTIVO, self::CA_ASUNTO, self::CA_SALUDO, self::CA_ENTRADA, self::CA_DESPEDIDA, self::CA_USUARIO, self::CA_ANEXOS, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_FCHSOLICITUD, self::CA_HORASOLICITUD, self::CA_FCHPRESENTACION, self::CA_FCHANULADO, self::CA_USUANULADO, self::CA_EMPRESA, self::CA_DATOSAG, self::CA_FUENTE, self::CA_IDG_ENVIO_OPORTUNO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion', 'ca_idcontacto', 'ca_consecutivo', 'ca_asunto', 'ca_saludo', 'ca_entrada', 'ca_despedida', 'ca_usuario', 'ca_anexos', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchsolicitud', 'ca_horasolicitud', 'ca_fchpresentacion', 'ca_fchanulado', 'ca_usuanulado', 'ca_empresa', 'ca_datosag', 'ca_fuente', 'ca_idg_envio_oportuno', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion' => 0, 'CaIdcontacto' => 1, 'CaConsecutivo' => 2, 'CaAsunto' => 3, 'CaSaludo' => 4, 'CaEntrada' => 5, 'CaDespedida' => 6, 'CaUsuario' => 7, 'CaAnexos' => 8, 'CaFchcreado' => 9, 'CaUsucreado' => 10, 'CaFchactualizado' => 11, 'CaUsuactualizado' => 12, 'CaFchsolicitud' => 13, 'CaHorasolicitud' => 14, 'CaFchpresentacion' => 15, 'CaFchanulado' => 16, 'CaUsuanulado' => 17, 'CaEmpresa' => 18, 'CaDatosag' => 19, 'CaFuente' => 20, 'CaIdgEnvioOportuno' => 21, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcotizacion' => 0, 'caIdcontacto' => 1, 'caConsecutivo' => 2, 'caAsunto' => 3, 'caSaludo' => 4, 'caEntrada' => 5, 'caDespedida' => 6, 'caUsuario' => 7, 'caAnexos' => 8, 'caFchcreado' => 9, 'caUsucreado' => 10, 'caFchactualizado' => 11, 'caUsuactualizado' => 12, 'caFchsolicitud' => 13, 'caHorasolicitud' => 14, 'caFchpresentacion' => 15, 'caFchanulado' => 16, 'caUsuanulado' => 17, 'caEmpresa' => 18, 'caDatosag' => 19, 'caFuente' => 20, 'caIdgEnvioOportuno' => 21, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCOTIZACION => 0, self::CA_IDCONTACTO => 1, self::CA_CONSECUTIVO => 2, self::CA_ASUNTO => 3, self::CA_SALUDO => 4, self::CA_ENTRADA => 5, self::CA_DESPEDIDA => 6, self::CA_USUARIO => 7, self::CA_ANEXOS => 8, self::CA_FCHCREADO => 9, self::CA_USUCREADO => 10, self::CA_FCHACTUALIZADO => 11, self::CA_USUACTUALIZADO => 12, self::CA_FCHSOLICITUD => 13, self::CA_HORASOLICITUD => 14, self::CA_FCHPRESENTACION => 15, self::CA_FCHANULADO => 16, self::CA_USUANULADO => 17, self::CA_EMPRESA => 18, self::CA_DATOSAG => 19, self::CA_FUENTE => 20, self::CA_IDG_ENVIO_OPORTUNO => 21, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion' => 0, 'ca_idcontacto' => 1, 'ca_consecutivo' => 2, 'ca_asunto' => 3, 'ca_saludo' => 4, 'ca_entrada' => 5, 'ca_despedida' => 6, 'ca_usuario' => 7, 'ca_anexos' => 8, 'ca_fchcreado' => 9, 'ca_usucreado' => 10, 'ca_fchactualizado' => 11, 'ca_usuactualizado' => 12, 'ca_fchsolicitud' => 13, 'ca_horasolicitud' => 14, 'ca_fchpresentacion' => 15, 'ca_fchanulado' => 16, 'ca_usuanulado' => 17, 'ca_empresa' => 18, 'ca_datosag' => 19, 'ca_fuente' => 20, 'ca_idg_envio_oportuno' => 21, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new CotizacionMapBuilder();
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
		return str_replace(CotizacionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CotizacionPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotizacionPeer::CA_IDCONTACTO);

		$criteria->addSelectColumn(CotizacionPeer::CA_CONSECUTIVO);

		$criteria->addSelectColumn(CotizacionPeer::CA_ASUNTO);

		$criteria->addSelectColumn(CotizacionPeer::CA_SALUDO);

		$criteria->addSelectColumn(CotizacionPeer::CA_ENTRADA);

		$criteria->addSelectColumn(CotizacionPeer::CA_DESPEDIDA);

		$criteria->addSelectColumn(CotizacionPeer::CA_USUARIO);

		$criteria->addSelectColumn(CotizacionPeer::CA_ANEXOS);

		$criteria->addSelectColumn(CotizacionPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(CotizacionPeer::CA_USUCREADO);

		$criteria->addSelectColumn(CotizacionPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(CotizacionPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(CotizacionPeer::CA_FCHSOLICITUD);

		$criteria->addSelectColumn(CotizacionPeer::CA_HORASOLICITUD);

		$criteria->addSelectColumn(CotizacionPeer::CA_FCHPRESENTACION);

		$criteria->addSelectColumn(CotizacionPeer::CA_FCHANULADO);

		$criteria->addSelectColumn(CotizacionPeer::CA_USUANULADO);

		$criteria->addSelectColumn(CotizacionPeer::CA_EMPRESA);

		$criteria->addSelectColumn(CotizacionPeer::CA_DATOSAG);

		$criteria->addSelectColumn(CotizacionPeer::CA_FUENTE);

		$criteria->addSelectColumn(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotizacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseCotizacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotizacionPeer', $criteria, $con);
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
		$objects = CotizacionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return CotizacionPeer::populateObjects(CotizacionPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotizacionPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseCotizacionPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			CotizacionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Cotizacion $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdcotizacion();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Cotizacion) {
				$key = (string) $value->getCaIdcotizacion();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Cotizacion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = CotizacionPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = CotizacionPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				CotizacionPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinContacto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotizacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotizacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotizacionPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(CotizacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotizacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotizacionPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(CotizacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotizacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotizacionPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinContacto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseCotizacionPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseCotizacionPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotizacionPeer::addSelectColumns($c);
		$startcol = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);
		ContactoPeer::addSelectColumns($c);

		$c->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotizacionPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotizacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotizacionPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = ContactoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ContactoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ContactoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ContactoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotizacion($obj1);

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

		CotizacionPeer::addSelectColumns($c);
		$startcol = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);
		NotTareaPeer::addSelectColumns($c);

		$c->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotizacionPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotizacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotizacionPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotizacion($obj1);

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

		CotizacionPeer::addSelectColumns($c);
		$startcol = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotizacionPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotizacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotizacionPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotizacion($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotizacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
		$criteria->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$criteria->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotizacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotizacionPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotizacionPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseCotizacionPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotizacionPeer::addSelectColumns($c);
		$startcol2 = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		ContactoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ContactoPeer::NUM_COLUMNS - ContactoPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
		$c->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$c->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotizacionPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotizacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotizacionPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = ContactoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = ContactoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ContactoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ContactoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotizacion($obj1);
			} 
			
			$key3 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = NotTareaPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					NotTareaPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addCotizacion($obj1);
			} 
			
			$key4 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = UsuarioPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					UsuarioPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addCotizacion($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptContacto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
				$criteria->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotizacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotizacionPeer', $criteria, $con);
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
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
				$criteria->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotizacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotizacionPeer', $criteria, $con);
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
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
				$criteria->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotizacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotizacionPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptContacto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseCotizacionPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseCotizacionPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotizacionPeer::addSelectColumns($c);
		$startcol2 = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
				$c->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotizacionPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotizacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotizacionPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = NotTareaPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					NotTareaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotizacion($obj1);

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
								$obj3->addCotizacion($obj1);

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

		CotizacionPeer::addSelectColumns($c);
		$startcol2 = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		ContactoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ContactoPeer::NUM_COLUMNS - ContactoPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
				$c->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotizacionPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotizacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotizacionPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = ContactoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ContactoPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ContactoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ContactoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotizacion($obj1);

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
								$obj3->addCotizacion($obj1);

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

		CotizacionPeer::addSelectColumns($c);
		$startcol2 = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		ContactoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ContactoPeer::NUM_COLUMNS - ContactoPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
				$c->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotizacionPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotizacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotizacionPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = ContactoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ContactoPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ContactoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ContactoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotizacion($obj1);

			} 
				
				$key3 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = NotTareaPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					NotTareaPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addCotizacion($obj1);

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
		return CotizacionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotizacionPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotizacionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(CotizacionPeer::CA_IDCOTIZACION) && $criteria->keyContainsValue(CotizacionPeer::CA_IDCOTIZACION) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.CotizacionPeer::CA_IDCOTIZACION.')');
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

		
    foreach (sfMixer::getCallables('BaseCotizacionPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseCotizacionPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotizacionPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotizacionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(CotizacionPeer::CA_IDCOTIZACION);
			$selectCriteria->add(CotizacionPeer::CA_IDCOTIZACION, $criteria->remove(CotizacionPeer::CA_IDCOTIZACION), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseCotizacionPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseCotizacionPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(CotizacionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												CotizacionPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Cotizacion) {
						CotizacionPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(CotizacionPeer::CA_IDCOTIZACION, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								CotizacionPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Cotizacion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotizacionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotizacionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotizacionPeer::DATABASE_NAME, CotizacionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotizacionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = CotizacionPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		$criteria->add(CotizacionPeer::CA_IDCOTIZACION, $pk);

		$v = CotizacionPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
			$criteria->add(CotizacionPeer::CA_IDCOTIZACION, $pks, Criteria::IN);
			$objs = CotizacionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseCotizacionPeer::DATABASE_NAME)->addTableBuilder(BaseCotizacionPeer::TABLE_NAME, BaseCotizacionPeer::getMapBuilder());

