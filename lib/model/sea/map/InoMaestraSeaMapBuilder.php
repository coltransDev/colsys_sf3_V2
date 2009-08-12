<?php



class InoMaestraSeaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.sea.map.InoMaestraSeaMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(InoMaestraSeaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(InoMaestraSeaPeer::TABLE_NAME);
		$tMap->setPhpName('InoMaestraSea');
		$tMap->setClassname('InoMaestraSea');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CA_FCHREFERENCIA', 'CaFchreferencia', 'DATE', true, null);

		$tMap->addPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'VARCHAR', true, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHEMBARQUE', 'CaFchembarque', 'DATE', false, null);

		$tMap->addColumn('CA_FCHARRIBO', 'CaFcharribo', 'DATE', false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDLINEA', 'CaIdlinea', 'INTEGER', 'tb_transporlineas', 'CA_IDLINEA', false, null);

		$tMap->addColumn('CA_MOTONAVE', 'CaMotonave', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CICLO', 'CaCiclo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MBLS', 'CaMbls', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCONFIRMACION', 'CaFchconfirmacion', 'DATE', false, null);

		$tMap->addColumn('CA_HORACONFIRMACION', 'CaHoraconfirmacion', 'TIME', false, null);

		$tMap->addColumn('CA_REGISTROADU', 'CaRegistroadu', 'VARCHAR', false, null);

		$tMap->addColumn('CA_REGISTROCAP', 'CaRegistrocap', 'VARCHAR', false, null);

		$tMap->addColumn('CA_BANDERA', 'CaBandera', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHLIBERACION', 'CaFchliberacion', 'DATE', false, null);

		$tMap->addColumn('CA_NROLIBERACION', 'CaNroliberacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ANULADO', 'CaAnulado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'DATE', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHLIQUIDADO', 'CaFchliquidado', 'DATE', false, null);

		$tMap->addColumn('CA_USULIQUIDADO', 'CaUsuliquidado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCERRADO', 'CaFchcerrado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCERRADO', 'CaUsucerrado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MENSAJE', 'CaMensaje', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHDESCONSOLIDACION', 'CaFchdesconsolidacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MNLLEGADA', 'CaMnllegada', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHREGISTROADU', 'CaFchregistroadu', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCONFIRMADO', 'CaFchconfirmado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCONFIRMADO', 'CaUsuconfirmado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ASUNTO_OTM', 'CaAsuntoOtm', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MENSAJE_OTM', 'CaMensajeOtm', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHLLEGADA_OTM', 'CaFchllegadaOtm', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CIUDAD_OTM', 'CaCiudadOtm', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCONFIRMA_OTM', 'CaFchconfirmaOtm', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCONFIRMA_OTM', 'CaUsuconfirmaOtm', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PROVISIONAL', 'CaProvisional', 'BOOLEAN', false, null);

		$tMap->addColumn('CA_SITIODEVOLUCION', 'CaSitiodevolucion', 'VARCHAR', false, null);

	} 
} 