<?php


abstract class BaseInoMaestraSeaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_inomaestra_sea';

	
	const CLASS_DEFAULT = 'lib.model.sea.InoMaestraSea';

	
	const NUM_COLUMNS = 43;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_FCHREFERENCIA = 'tb_inomaestra_sea.CA_FCHREFERENCIA';

	
	const CA_REFERENCIA = 'tb_inomaestra_sea.CA_REFERENCIA';

	
	const CA_IMPOEXPO = 'tb_inomaestra_sea.CA_IMPOEXPO';

	
	const CA_ORIGEN = 'tb_inomaestra_sea.CA_ORIGEN';

	
	const CA_DESTINO = 'tb_inomaestra_sea.CA_DESTINO';

	
	const CA_FCHEMBARQUE = 'tb_inomaestra_sea.CA_FCHEMBARQUE';

	
	const CA_FCHARRIBO = 'tb_inomaestra_sea.CA_FCHARRIBO';

	
	const CA_MODALIDAD = 'tb_inomaestra_sea.CA_MODALIDAD';

	
	const CA_IDLINEA = 'tb_inomaestra_sea.CA_IDLINEA';

	
	const CA_MOTONAVE = 'tb_inomaestra_sea.CA_MOTONAVE';

	
	const CA_CICLO = 'tb_inomaestra_sea.CA_CICLO';

	
	const CA_MBLS = 'tb_inomaestra_sea.CA_MBLS';

	
	const CA_OBSERVACIONES = 'tb_inomaestra_sea.CA_OBSERVACIONES';

	
	const CA_FCHCONFIRMACION = 'tb_inomaestra_sea.CA_FCHCONFIRMACION';

	
	const CA_HORACONFIRMACION = 'tb_inomaestra_sea.CA_HORACONFIRMACION';

	
	const CA_REGISTROADU = 'tb_inomaestra_sea.CA_REGISTROADU';

	
	const CA_REGISTROCAP = 'tb_inomaestra_sea.CA_REGISTROCAP';

	
	const CA_BANDERA = 'tb_inomaestra_sea.CA_BANDERA';

	
	const CA_FCHLIBERACION = 'tb_inomaestra_sea.CA_FCHLIBERACION';

	
	const CA_NROLIBERACION = 'tb_inomaestra_sea.CA_NROLIBERACION';

	
	const CA_ANULADO = 'tb_inomaestra_sea.CA_ANULADO';

	
	const CA_FCHCREADO = 'tb_inomaestra_sea.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_inomaestra_sea.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_inomaestra_sea.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_inomaestra_sea.CA_USUACTUALIZADO';

	
	const CA_FCHLIQUIDADO = 'tb_inomaestra_sea.CA_FCHLIQUIDADO';

	
	const CA_USULIQUIDADO = 'tb_inomaestra_sea.CA_USULIQUIDADO';

	
	const CA_FCHCERRADO = 'tb_inomaestra_sea.CA_FCHCERRADO';

	
	const CA_USUCERRADO = 'tb_inomaestra_sea.CA_USUCERRADO';

	
	const CA_MENSAJE = 'tb_inomaestra_sea.CA_MENSAJE';

	
	const CA_FCHDESCONSOLIDACION = 'tb_inomaestra_sea.CA_FCHDESCONSOLIDACION';

	
	const CA_MNLLEGADA = 'tb_inomaestra_sea.CA_MNLLEGADA';

	
	const CA_FCHREGISTROADU = 'tb_inomaestra_sea.CA_FCHREGISTROADU';

	
	const CA_FCHCONFIRMADO = 'tb_inomaestra_sea.CA_FCHCONFIRMADO';

	
	const CA_USUCONFIRMADO = 'tb_inomaestra_sea.CA_USUCONFIRMADO';

	
	const CA_ASUNTO_OTM = 'tb_inomaestra_sea.CA_ASUNTO_OTM';

	
	const CA_MENSAJE_OTM = 'tb_inomaestra_sea.CA_MENSAJE_OTM';

	
	const CA_FCHLLEGADA_OTM = 'tb_inomaestra_sea.CA_FCHLLEGADA_OTM';

	
	const CA_CIUDAD_OTM = 'tb_inomaestra_sea.CA_CIUDAD_OTM';

	
	const CA_FCHCONFIRMA_OTM = 'tb_inomaestra_sea.CA_FCHCONFIRMA_OTM';

	
	const CA_USUCONFIRMA_OTM = 'tb_inomaestra_sea.CA_USUCONFIRMA_OTM';

	
	const CA_PROVISIONAL = 'tb_inomaestra_sea.CA_PROVISIONAL';

	
	const CA_SITIODEVOLUCION = 'tb_inomaestra_sea.CA_SITIODEVOLUCION';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia', 'CaReferencia', 'CaImpoexpo', 'CaOrigen', 'CaDestino', 'CaFchembarque', 'CaFcharribo', 'CaModalidad', 'CaIdlinea', 'CaMotonave', 'CaCiclo', 'CaMbls', 'CaObservaciones', 'CaFchconfirmacion', 'CaHoraconfirmacion', 'CaRegistroadu', 'CaRegistrocap', 'CaBandera', 'CaFchliberacion', 'CaNroliberacion', 'CaAnulado', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchliquidado', 'CaUsuliquidado', 'CaFchcerrado', 'CaUsucerrado', 'CaMensaje', 'CaFchdesconsolidacion', 'CaMnllegada', 'CaFchregistroadu', 'CaFchconfirmado', 'CaUsuconfirmado', 'CaAsuntoOtm', 'CaMensajeOtm', 'CaFchllegadaOtm', 'CaCiudadOtm', 'CaFchconfirmaOtm', 'CaUsuconfirmaOtm', 'CaProvisional', 'CaSitiodevolucion', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caFchreferencia', 'caReferencia', 'caImpoexpo', 'caOrigen', 'caDestino', 'caFchembarque', 'caFcharribo', 'caModalidad', 'caIdlinea', 'caMotonave', 'caCiclo', 'caMbls', 'caObservaciones', 'caFchconfirmacion', 'caHoraconfirmacion', 'caRegistroadu', 'caRegistrocap', 'caBandera', 'caFchliberacion', 'caNroliberacion', 'caAnulado', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caFchliquidado', 'caUsuliquidado', 'caFchcerrado', 'caUsucerrado', 'caMensaje', 'caFchdesconsolidacion', 'caMnllegada', 'caFchregistroadu', 'caFchconfirmado', 'caUsuconfirmado', 'caAsuntoOtm', 'caMensajeOtm', 'caFchllegadaOtm', 'caCiudadOtm', 'caFchconfirmaOtm', 'caUsuconfirmaOtm', 'caProvisional', 'caSitiodevolucion', ),
		BasePeer::TYPE_COLNAME => array (self::CA_FCHREFERENCIA, self::CA_REFERENCIA, self::CA_IMPOEXPO, self::CA_ORIGEN, self::CA_DESTINO, self::CA_FCHEMBARQUE, self::CA_FCHARRIBO, self::CA_MODALIDAD, self::CA_IDLINEA, self::CA_MOTONAVE, self::CA_CICLO, self::CA_MBLS, self::CA_OBSERVACIONES, self::CA_FCHCONFIRMACION, self::CA_HORACONFIRMACION, self::CA_REGISTROADU, self::CA_REGISTROCAP, self::CA_BANDERA, self::CA_FCHLIBERACION, self::CA_NROLIBERACION, self::CA_ANULADO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_FCHLIQUIDADO, self::CA_USULIQUIDADO, self::CA_FCHCERRADO, self::CA_USUCERRADO, self::CA_MENSAJE, self::CA_FCHDESCONSOLIDACION, self::CA_MNLLEGADA, self::CA_FCHREGISTROADU, self::CA_FCHCONFIRMADO, self::CA_USUCONFIRMADO, self::CA_ASUNTO_OTM, self::CA_MENSAJE_OTM, self::CA_FCHLLEGADA_OTM, self::CA_CIUDAD_OTM, self::CA_FCHCONFIRMA_OTM, self::CA_USUCONFIRMA_OTM, self::CA_PROVISIONAL, self::CA_SITIODEVOLUCION, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia', 'ca_referencia', 'ca_impoexpo', 'ca_origen', 'ca_destino', 'ca_fchembarque', 'ca_fcharribo', 'ca_modalidad', 'ca_idlinea', 'ca_motonave', 'ca_ciclo', 'ca_mbls', 'ca_observaciones', 'ca_fchconfirmacion', 'ca_horaconfirmacion', 'ca_registroadu', 'ca_registrocap', 'ca_bandera', 'ca_fchliberacion', 'ca_nroliberacion', 'ca_anulado', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchliquidado', 'ca_usuliquidado', 'ca_fchcerrado', 'ca_usucerrado', 'ca_mensaje', 'ca_fchdesconsolidacion', 'ca_mnllegada', 'ca_fchregistroadu', 'ca_fchconfirmado', 'ca_usuconfirmado', 'ca_asunto_otm', 'ca_mensaje_otm', 'ca_fchllegada_otm', 'ca_ciudad_otm', 'ca_fchconfirma_otm', 'ca_usuconfirma_otm', 'ca_provisional', 'ca_sitiodevolucion', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia' => 0, 'CaReferencia' => 1, 'CaImpoexpo' => 2, 'CaOrigen' => 3, 'CaDestino' => 4, 'CaFchembarque' => 5, 'CaFcharribo' => 6, 'CaModalidad' => 7, 'CaIdlinea' => 8, 'CaMotonave' => 9, 'CaCiclo' => 10, 'CaMbls' => 11, 'CaObservaciones' => 12, 'CaFchconfirmacion' => 13, 'CaHoraconfirmacion' => 14, 'CaRegistroadu' => 15, 'CaRegistrocap' => 16, 'CaBandera' => 17, 'CaFchliberacion' => 18, 'CaNroliberacion' => 19, 'CaAnulado' => 20, 'CaFchcreado' => 21, 'CaUsucreado' => 22, 'CaFchactualizado' => 23, 'CaUsuactualizado' => 24, 'CaFchliquidado' => 25, 'CaUsuliquidado' => 26, 'CaFchcerrado' => 27, 'CaUsucerrado' => 28, 'CaMensaje' => 29, 'CaFchdesconsolidacion' => 30, 'CaMnllegada' => 31, 'CaFchregistroadu' => 32, 'CaFchconfirmado' => 33, 'CaUsuconfirmado' => 34, 'CaAsuntoOtm' => 35, 'CaMensajeOtm' => 36, 'CaFchllegadaOtm' => 37, 'CaCiudadOtm' => 38, 'CaFchconfirmaOtm' => 39, 'CaUsuconfirmaOtm' => 40, 'CaProvisional' => 41, 'CaSitiodevolucion' => 42, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caFchreferencia' => 0, 'caReferencia' => 1, 'caImpoexpo' => 2, 'caOrigen' => 3, 'caDestino' => 4, 'caFchembarque' => 5, 'caFcharribo' => 6, 'caModalidad' => 7, 'caIdlinea' => 8, 'caMotonave' => 9, 'caCiclo' => 10, 'caMbls' => 11, 'caObservaciones' => 12, 'caFchconfirmacion' => 13, 'caHoraconfirmacion' => 14, 'caRegistroadu' => 15, 'caRegistrocap' => 16, 'caBandera' => 17, 'caFchliberacion' => 18, 'caNroliberacion' => 19, 'caAnulado' => 20, 'caFchcreado' => 21, 'caUsucreado' => 22, 'caFchactualizado' => 23, 'caUsuactualizado' => 24, 'caFchliquidado' => 25, 'caUsuliquidado' => 26, 'caFchcerrado' => 27, 'caUsucerrado' => 28, 'caMensaje' => 29, 'caFchdesconsolidacion' => 30, 'caMnllegada' => 31, 'caFchregistroadu' => 32, 'caFchconfirmado' => 33, 'caUsuconfirmado' => 34, 'caAsuntoOtm' => 35, 'caMensajeOtm' => 36, 'caFchllegadaOtm' => 37, 'caCiudadOtm' => 38, 'caFchconfirmaOtm' => 39, 'caUsuconfirmaOtm' => 40, 'caProvisional' => 41, 'caSitiodevolucion' => 42, ),
		BasePeer::TYPE_COLNAME => array (self::CA_FCHREFERENCIA => 0, self::CA_REFERENCIA => 1, self::CA_IMPOEXPO => 2, self::CA_ORIGEN => 3, self::CA_DESTINO => 4, self::CA_FCHEMBARQUE => 5, self::CA_FCHARRIBO => 6, self::CA_MODALIDAD => 7, self::CA_IDLINEA => 8, self::CA_MOTONAVE => 9, self::CA_CICLO => 10, self::CA_MBLS => 11, self::CA_OBSERVACIONES => 12, self::CA_FCHCONFIRMACION => 13, self::CA_HORACONFIRMACION => 14, self::CA_REGISTROADU => 15, self::CA_REGISTROCAP => 16, self::CA_BANDERA => 17, self::CA_FCHLIBERACION => 18, self::CA_NROLIBERACION => 19, self::CA_ANULADO => 20, self::CA_FCHCREADO => 21, self::CA_USUCREADO => 22, self::CA_FCHACTUALIZADO => 23, self::CA_USUACTUALIZADO => 24, self::CA_FCHLIQUIDADO => 25, self::CA_USULIQUIDADO => 26, self::CA_FCHCERRADO => 27, self::CA_USUCERRADO => 28, self::CA_MENSAJE => 29, self::CA_FCHDESCONSOLIDACION => 30, self::CA_MNLLEGADA => 31, self::CA_FCHREGISTROADU => 32, self::CA_FCHCONFIRMADO => 33, self::CA_USUCONFIRMADO => 34, self::CA_ASUNTO_OTM => 35, self::CA_MENSAJE_OTM => 36, self::CA_FCHLLEGADA_OTM => 37, self::CA_CIUDAD_OTM => 38, self::CA_FCHCONFIRMA_OTM => 39, self::CA_USUCONFIRMA_OTM => 40, self::CA_PROVISIONAL => 41, self::CA_SITIODEVOLUCION => 42, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia' => 0, 'ca_referencia' => 1, 'ca_impoexpo' => 2, 'ca_origen' => 3, 'ca_destino' => 4, 'ca_fchembarque' => 5, 'ca_fcharribo' => 6, 'ca_modalidad' => 7, 'ca_idlinea' => 8, 'ca_motonave' => 9, 'ca_ciclo' => 10, 'ca_mbls' => 11, 'ca_observaciones' => 12, 'ca_fchconfirmacion' => 13, 'ca_horaconfirmacion' => 14, 'ca_registroadu' => 15, 'ca_registrocap' => 16, 'ca_bandera' => 17, 'ca_fchliberacion' => 18, 'ca_nroliberacion' => 19, 'ca_anulado' => 20, 'ca_fchcreado' => 21, 'ca_usucreado' => 22, 'ca_fchactualizado' => 23, 'ca_usuactualizado' => 24, 'ca_fchliquidado' => 25, 'ca_usuliquidado' => 26, 'ca_fchcerrado' => 27, 'ca_usucerrado' => 28, 'ca_mensaje' => 29, 'ca_fchdesconsolidacion' => 30, 'ca_mnllegada' => 31, 'ca_fchregistroadu' => 32, 'ca_fchconfirmado' => 33, 'ca_usuconfirmado' => 34, 'ca_asunto_otm' => 35, 'ca_mensaje_otm' => 36, 'ca_fchllegada_otm' => 37, 'ca_ciudad_otm' => 38, 'ca_fchconfirma_otm' => 39, 'ca_usuconfirma_otm' => 40, 'ca_provisional' => 41, 'ca_sitiodevolucion' => 42, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new InoMaestraSeaMapBuilder();
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
		return str_replace(InoMaestraSeaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHREFERENCIA);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_ORIGEN);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_DESTINO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHEMBARQUE);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHARRIBO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_IDLINEA);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_MOTONAVE);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_CICLO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_MBLS);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHCONFIRMACION);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_HORACONFIRMACION);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_REGISTROADU);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_REGISTROCAP);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_BANDERA);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHLIBERACION);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_NROLIBERACION);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_ANULADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_USUCREADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHLIQUIDADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_USULIQUIDADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHCERRADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_USUCERRADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_MENSAJE);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHDESCONSOLIDACION);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_MNLLEGADA);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHREGISTROADU);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHCONFIRMADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_USUCONFIRMADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_ASUNTO_OTM);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_MENSAJE_OTM);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHLLEGADA_OTM);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_CIUDAD_OTM);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHCONFIRMA_OTM);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_USUCONFIRMA_OTM);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_PROVISIONAL);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_SITIODEVOLUCION);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoMaestraSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoMaestraSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseInoMaestraSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraSeaPeer', $criteria, $con);
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
		$objects = InoMaestraSeaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return InoMaestraSeaPeer::populateObjects(InoMaestraSeaPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoMaestraSeaPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraSeaPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			InoMaestraSeaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(InoMaestraSea $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaReferencia();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof InoMaestraSea) {
				$key = (string) $value->getCaReferencia();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or InoMaestraSea object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 1] === null) {
			return null;
		}
		return (string) $row[$startcol + 1];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = InoMaestraSeaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = InoMaestraSeaPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				InoMaestraSeaPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoMaestraSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoMaestraSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoMaestraSeaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoMaestraSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraSeaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinTransportador(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseInoMaestraSeaPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraSeaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol = (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(array(InoMaestraSeaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoMaestraSeaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoMaestraSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoMaestraSeaPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TransportadorPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TransportadorPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoMaestraSea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoMaestraSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoMaestraSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoMaestraSeaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoMaestraSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraSeaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseInoMaestraSeaPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraSeaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol2 = (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(InoMaestraSeaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoMaestraSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoMaestraSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoMaestraSeaPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = TransportadorPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoMaestraSea($obj1);
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
		return InoMaestraSeaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoMaestraSeaPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoMaestraSeaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseInoMaestraSeaPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraSeaPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoMaestraSeaPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoMaestraSeaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(InoMaestraSeaPeer::CA_REFERENCIA);
			$selectCriteria->add(InoMaestraSeaPeer::CA_REFERENCIA, $criteria->remove(InoMaestraSeaPeer::CA_REFERENCIA), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInoMaestraSeaPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraSeaPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(InoMaestraSeaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												InoMaestraSeaPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof InoMaestraSea) {
						InoMaestraSeaPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(InoMaestraSeaPeer::CA_REFERENCIA, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								InoMaestraSeaPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(InoMaestraSea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoMaestraSeaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoMaestraSeaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoMaestraSeaPeer::DATABASE_NAME, InoMaestraSeaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoMaestraSeaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = InoMaestraSeaPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		$criteria->add(InoMaestraSeaPeer::CA_REFERENCIA, $pk);

		$v = InoMaestraSeaPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
			$criteria->add(InoMaestraSeaPeer::CA_REFERENCIA, $pks, Criteria::IN);
			$objs = InoMaestraSeaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseInoMaestraSeaPeer::DATABASE_NAME)->addTableBuilder(BaseInoMaestraSeaPeer::TABLE_NAME, BaseInoMaestraSeaPeer::getMapBuilder());

