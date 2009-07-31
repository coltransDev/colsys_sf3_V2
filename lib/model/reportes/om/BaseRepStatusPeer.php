<?php


abstract class BaseRepStatusPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_repstatus';

	
	const CLASS_DEFAULT = 'lib.model.reportes.RepStatus';

	
	const NUM_COLUMNS = 25;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDSTATUS = 'tb_repstatus.CA_IDSTATUS';

	
	const CA_IDREPORTE = 'tb_repstatus.CA_IDREPORTE';

	
	const CA_IDEMAIL = 'tb_repstatus.CA_IDEMAIL';

	
	const CA_FCHSTATUS = 'tb_repstatus.CA_FCHSTATUS';

	
	const CA_STATUS = 'tb_repstatus.CA_STATUS';

	
	const CA_COMENTARIOS = 'tb_repstatus.CA_COMENTARIOS';

	
	const CA_FCHRECIBO = 'tb_repstatus.CA_FCHRECIBO';

	
	const CA_FCHENVIO = 'tb_repstatus.CA_FCHENVIO';

	
	const CA_USUENVIO = 'tb_repstatus.CA_USUENVIO';

	
	const CA_ETAPA = 'tb_repstatus.CA_ETAPA';

	
	const CA_INTRODUCCION = 'tb_repstatus.CA_INTRODUCCION';

	
	const CA_FCHSALIDA = 'tb_repstatus.CA_FCHSALIDA';

	
	const CA_FCHLLEGADA = 'tb_repstatus.CA_FCHLLEGADA';

	
	const CA_FCHCONTINUACION = 'tb_repstatus.CA_FCHCONTINUACION';

	
	const CA_PIEZAS = 'tb_repstatus.CA_PIEZAS';

	
	const CA_PESO = 'tb_repstatus.CA_PESO';

	
	const CA_VOLUMEN = 'tb_repstatus.CA_VOLUMEN';

	
	const CA_DOCTRANSPORTE = 'tb_repstatus.CA_DOCTRANSPORTE';

	
	const CA_IDNAVE = 'tb_repstatus.CA_IDNAVE';

	
	const CA_DOCMASTER = 'tb_repstatus.CA_DOCMASTER';

	
	const CA_EQUIPOS = 'tb_repstatus.CA_EQUIPOS';

	
	const CA_HORASALIDA = 'tb_repstatus.CA_HORASALIDA';

	
	const CA_HORALLEGADA = 'tb_repstatus.CA_HORALLEGADA';

	
	const CA_IDETAPA = 'tb_repstatus.CA_IDETAPA';

	
	const CA_PROPIEDADES = 'tb_repstatus.CA_PROPIEDADES';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdstatus', 'CaIdreporte', 'CaIdemail', 'CaFchstatus', 'CaStatus', 'CaComentarios', 'CaFchrecibo', 'CaFchenvio', 'CaUsuenvio', 'CaEtapa', 'CaIntroduccion', 'CaFchsalida', 'CaFchllegada', 'CaFchcontinuacion', 'CaPiezas', 'CaPeso', 'CaVolumen', 'CaDoctransporte', 'CaIdnave', 'CaDocmaster', 'CaEquipos', 'CaHorasalida', 'CaHorallegada', 'CaIdetapa', 'CaPropiedades', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdstatus', 'caIdreporte', 'caIdemail', 'caFchstatus', 'caStatus', 'caComentarios', 'caFchrecibo', 'caFchenvio', 'caUsuenvio', 'caEtapa', 'caIntroduccion', 'caFchsalida', 'caFchllegada', 'caFchcontinuacion', 'caPiezas', 'caPeso', 'caVolumen', 'caDoctransporte', 'caIdnave', 'caDocmaster', 'caEquipos', 'caHorasalida', 'caHorallegada', 'caIdetapa', 'caPropiedades', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDSTATUS, self::CA_IDREPORTE, self::CA_IDEMAIL, self::CA_FCHSTATUS, self::CA_STATUS, self::CA_COMENTARIOS, self::CA_FCHRECIBO, self::CA_FCHENVIO, self::CA_USUENVIO, self::CA_ETAPA, self::CA_INTRODUCCION, self::CA_FCHSALIDA, self::CA_FCHLLEGADA, self::CA_FCHCONTINUACION, self::CA_PIEZAS, self::CA_PESO, self::CA_VOLUMEN, self::CA_DOCTRANSPORTE, self::CA_IDNAVE, self::CA_DOCMASTER, self::CA_EQUIPOS, self::CA_HORASALIDA, self::CA_HORALLEGADA, self::CA_IDETAPA, self::CA_PROPIEDADES, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idstatus', 'ca_idreporte', 'ca_idemail', 'ca_fchstatus', 'ca_status', 'ca_comentarios', 'ca_fchrecibo', 'ca_fchenvio', 'ca_usuenvio', 'ca_etapa', 'ca_introduccion', 'ca_fchsalida', 'ca_fchllegada', 'ca_fchcontinuacion', 'ca_piezas', 'ca_peso', 'ca_volumen', 'ca_doctransporte', 'ca_idnave', 'ca_docmaster', 'ca_equipos', 'ca_horasalida', 'ca_horallegada', 'ca_idetapa', 'ca_propiedades', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdstatus' => 0, 'CaIdreporte' => 1, 'CaIdemail' => 2, 'CaFchstatus' => 3, 'CaStatus' => 4, 'CaComentarios' => 5, 'CaFchrecibo' => 6, 'CaFchenvio' => 7, 'CaUsuenvio' => 8, 'CaEtapa' => 9, 'CaIntroduccion' => 10, 'CaFchsalida' => 11, 'CaFchllegada' => 12, 'CaFchcontinuacion' => 13, 'CaPiezas' => 14, 'CaPeso' => 15, 'CaVolumen' => 16, 'CaDoctransporte' => 17, 'CaIdnave' => 18, 'CaDocmaster' => 19, 'CaEquipos' => 20, 'CaHorasalida' => 21, 'CaHorallegada' => 22, 'CaIdetapa' => 23, 'CaPropiedades' => 24, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdstatus' => 0, 'caIdreporte' => 1, 'caIdemail' => 2, 'caFchstatus' => 3, 'caStatus' => 4, 'caComentarios' => 5, 'caFchrecibo' => 6, 'caFchenvio' => 7, 'caUsuenvio' => 8, 'caEtapa' => 9, 'caIntroduccion' => 10, 'caFchsalida' => 11, 'caFchllegada' => 12, 'caFchcontinuacion' => 13, 'caPiezas' => 14, 'caPeso' => 15, 'caVolumen' => 16, 'caDoctransporte' => 17, 'caIdnave' => 18, 'caDocmaster' => 19, 'caEquipos' => 20, 'caHorasalida' => 21, 'caHorallegada' => 22, 'caIdetapa' => 23, 'caPropiedades' => 24, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDSTATUS => 0, self::CA_IDREPORTE => 1, self::CA_IDEMAIL => 2, self::CA_FCHSTATUS => 3, self::CA_STATUS => 4, self::CA_COMENTARIOS => 5, self::CA_FCHRECIBO => 6, self::CA_FCHENVIO => 7, self::CA_USUENVIO => 8, self::CA_ETAPA => 9, self::CA_INTRODUCCION => 10, self::CA_FCHSALIDA => 11, self::CA_FCHLLEGADA => 12, self::CA_FCHCONTINUACION => 13, self::CA_PIEZAS => 14, self::CA_PESO => 15, self::CA_VOLUMEN => 16, self::CA_DOCTRANSPORTE => 17, self::CA_IDNAVE => 18, self::CA_DOCMASTER => 19, self::CA_EQUIPOS => 20, self::CA_HORASALIDA => 21, self::CA_HORALLEGADA => 22, self::CA_IDETAPA => 23, self::CA_PROPIEDADES => 24, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idstatus' => 0, 'ca_idreporte' => 1, 'ca_idemail' => 2, 'ca_fchstatus' => 3, 'ca_status' => 4, 'ca_comentarios' => 5, 'ca_fchrecibo' => 6, 'ca_fchenvio' => 7, 'ca_usuenvio' => 8, 'ca_etapa' => 9, 'ca_introduccion' => 10, 'ca_fchsalida' => 11, 'ca_fchllegada' => 12, 'ca_fchcontinuacion' => 13, 'ca_piezas' => 14, 'ca_peso' => 15, 'ca_volumen' => 16, 'ca_doctransporte' => 17, 'ca_idnave' => 18, 'ca_docmaster' => 19, 'ca_equipos' => 20, 'ca_horasalida' => 21, 'ca_horallegada' => 22, 'ca_idetapa' => 23, 'ca_propiedades' => 24, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new RepStatusMapBuilder();
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
		return str_replace(RepStatusPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RepStatusPeer::CA_IDSTATUS);

		$criteria->addSelectColumn(RepStatusPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(RepStatusPeer::CA_IDEMAIL);

		$criteria->addSelectColumn(RepStatusPeer::CA_FCHSTATUS);

		$criteria->addSelectColumn(RepStatusPeer::CA_STATUS);

		$criteria->addSelectColumn(RepStatusPeer::CA_COMENTARIOS);

		$criteria->addSelectColumn(RepStatusPeer::CA_FCHRECIBO);

		$criteria->addSelectColumn(RepStatusPeer::CA_FCHENVIO);

		$criteria->addSelectColumn(RepStatusPeer::CA_USUENVIO);

		$criteria->addSelectColumn(RepStatusPeer::CA_ETAPA);

		$criteria->addSelectColumn(RepStatusPeer::CA_INTRODUCCION);

		$criteria->addSelectColumn(RepStatusPeer::CA_FCHSALIDA);

		$criteria->addSelectColumn(RepStatusPeer::CA_FCHLLEGADA);

		$criteria->addSelectColumn(RepStatusPeer::CA_FCHCONTINUACION);

		$criteria->addSelectColumn(RepStatusPeer::CA_PIEZAS);

		$criteria->addSelectColumn(RepStatusPeer::CA_PESO);

		$criteria->addSelectColumn(RepStatusPeer::CA_VOLUMEN);

		$criteria->addSelectColumn(RepStatusPeer::CA_DOCTRANSPORTE);

		$criteria->addSelectColumn(RepStatusPeer::CA_IDNAVE);

		$criteria->addSelectColumn(RepStatusPeer::CA_DOCMASTER);

		$criteria->addSelectColumn(RepStatusPeer::CA_EQUIPOS);

		$criteria->addSelectColumn(RepStatusPeer::CA_HORASALIDA);

		$criteria->addSelectColumn(RepStatusPeer::CA_HORALLEGADA);

		$criteria->addSelectColumn(RepStatusPeer::CA_IDETAPA);

		$criteria->addSelectColumn(RepStatusPeer::CA_PROPIEDADES);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepStatusPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepStatusPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseRepStatusPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusPeer', $criteria, $con);
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
		$objects = RepStatusPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return RepStatusPeer::populateObjects(RepStatusPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepStatusPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			RepStatusPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(RepStatus $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdstatus();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof RepStatus) {
				$key = (string) $value->getCaIdstatus();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or RepStatus object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = RepStatusPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = RepStatusPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = RepStatusPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				RepStatusPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinReporte(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepStatusPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepStatusPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepStatusPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseRepStatusPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinEmail(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepStatusPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepStatusPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepStatusPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);


    foreach (sfMixer::getCallables('BaseRepStatusPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinTrackingEtapa(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepStatusPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepStatusPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepStatusPeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseRepStatusPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseRepStatusPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepStatusPeer::addSelectColumns($c);
		$startcol = (RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS);
		ReportePeer::addSelectColumns($c);

		$c->addJoin(array(RepStatusPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepStatusPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepStatusPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = RepStatusPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepStatusPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addRepStatus($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinEmail(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepStatusPeer::addSelectColumns($c);
		$startcol = (RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS);
		EmailPeer::addSelectColumns($c);

		$c->addJoin(array(RepStatusPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepStatusPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepStatusPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = RepStatusPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepStatusPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = EmailPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = EmailPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = EmailPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					EmailPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepStatus($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinTrackingEtapa(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepStatusPeer::addSelectColumns($c);
		$startcol = (RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS);
		TrackingEtapaPeer::addSelectColumns($c);

		$c->addJoin(array(RepStatusPeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepStatusPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepStatusPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = RepStatusPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepStatusPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TrackingEtapaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TrackingEtapaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TrackingEtapaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepStatus($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepStatusPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepStatusPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepStatusPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$criteria->addJoin(array(RepStatusPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);
		$criteria->addJoin(array(RepStatusPeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepStatusPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseRepStatusPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepStatusPeer::addSelectColumns($c);
		$startcol2 = (RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		EmailPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (EmailPeer::NUM_COLUMNS - EmailPeer::NUM_LAZY_LOAD_COLUMNS);

		TrackingEtapaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (TrackingEtapaPeer::NUM_COLUMNS - TrackingEtapaPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(RepStatusPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$c->addJoin(array(RepStatusPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);
		$c->addJoin(array(RepStatusPeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepStatusPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepStatusPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepStatusPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepStatusPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addRepStatus($obj1);
			} 
			
			$key3 = EmailPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = EmailPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = EmailPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					EmailPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addRepStatus($obj1);
			} 
			
			$key4 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = TrackingEtapaPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TrackingEtapaPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addRepStatus($obj1);
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
			RepStatusPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(RepStatusPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);
				$criteria->addJoin(array(RepStatusPeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepStatusPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptEmail(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepStatusPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(RepStatusPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$criteria->addJoin(array(RepStatusPeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepStatusPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptTrackingEtapa(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepStatusPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(RepStatusPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$criteria->addJoin(array(RepStatusPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepStatusPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseRepStatusPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepStatusPeer::addSelectColumns($c);
		$startcol2 = (RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS);

		EmailPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (EmailPeer::NUM_COLUMNS - EmailPeer::NUM_LAZY_LOAD_COLUMNS);

		TrackingEtapaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TrackingEtapaPeer::NUM_COLUMNS - TrackingEtapaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(RepStatusPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);
				$c->addJoin(array(RepStatusPeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepStatusPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepStatusPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepStatusPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepStatusPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = EmailPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = EmailPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = EmailPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					EmailPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRepStatus($obj1);

			} 
				
				$key3 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TrackingEtapaPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TrackingEtapaPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addRepStatus($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptEmail(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepStatusPeer::addSelectColumns($c);
		$startcol2 = (RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		TrackingEtapaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TrackingEtapaPeer::NUM_COLUMNS - TrackingEtapaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(RepStatusPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$c->addJoin(array(RepStatusPeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepStatusPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepStatusPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepStatusPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepStatusPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addRepStatus($obj1);

			} 
				
				$key3 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TrackingEtapaPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TrackingEtapaPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addRepStatus($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptTrackingEtapa(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepStatusPeer::addSelectColumns($c);
		$startcol2 = (RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		EmailPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (EmailPeer::NUM_COLUMNS - EmailPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(RepStatusPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$c->addJoin(array(RepStatusPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepStatusPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepStatusPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepStatusPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepStatusPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addRepStatus($obj1);

			} 
				
				$key3 = EmailPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = EmailPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = EmailPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					EmailPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addRepStatus($obj1);

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
		return RepStatusPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepStatusPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRepStatusPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(RepStatusPeer::CA_IDSTATUS) && $criteria->keyContainsValue(RepStatusPeer::CA_IDSTATUS) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.RepStatusPeer::CA_IDSTATUS.')');
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

		
    foreach (sfMixer::getCallables('BaseRepStatusPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepStatusPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRepStatusPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(RepStatusPeer::CA_IDSTATUS);
			$selectCriteria->add(RepStatusPeer::CA_IDSTATUS, $criteria->remove(RepStatusPeer::CA_IDSTATUS), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseRepStatusPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseRepStatusPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(RepStatusPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												RepStatusPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof RepStatus) {
						RepStatusPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RepStatusPeer::CA_IDSTATUS, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								RepStatusPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(RepStatus $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RepStatusPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RepStatusPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RepStatusPeer::DATABASE_NAME, RepStatusPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RepStatusPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = RepStatusPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(RepStatusPeer::DATABASE_NAME);
		$criteria->add(RepStatusPeer::CA_IDSTATUS, $pk);

		$v = RepStatusPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(RepStatusPeer::DATABASE_NAME);
			$criteria->add(RepStatusPeer::CA_IDSTATUS, $pks, Criteria::IN);
			$objs = RepStatusPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseRepStatusPeer::DATABASE_NAME)->addTableBuilder(BaseRepStatusPeer::TABLE_NAME, BaseRepStatusPeer::getMapBuilder());

