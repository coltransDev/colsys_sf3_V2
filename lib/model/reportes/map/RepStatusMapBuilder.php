<?php



class RepStatusMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.reportes.map.RepStatusMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(RepStatusPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepStatusPeer::TABLE_NAME);
		$tMap->setPhpName('RepStatus');
		$tMap->setClassname('RepStatus');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_repstatus_id');

		$tMap->addPrimaryKey('CA_IDSTATUS', 'CaIdstatus', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER', 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addForeignKey('CA_IDEMAIL', 'CaIdemail', 'INTEGER', 'tb_emails', 'CA_IDEMAIL', false, null);

		$tMap->addColumn('CA_FCHSTATUS', 'CaFchstatus', 'DATE', false, null);

		$tMap->addColumn('CA_STATUS', 'CaStatus', 'VARCHAR', false, null);

		$tMap->addColumn('CA_COMENTARIOS', 'CaComentarios', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHRECIBO', 'CaFchrecibo', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_FCHENVIO', 'CaFchenvio', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUENVIO', 'CaUsuenvio', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ETAPA', 'CaEtapa', 'VARCHAR', false, null);

		$tMap->addColumn('CA_INTRODUCCION', 'CaIntroduccion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHSALIDA', 'CaFchsalida', 'DATE', false, null);

		$tMap->addColumn('CA_FCHLLEGADA', 'CaFchllegada', 'DATE', false, null);

		$tMap->addColumn('CA_FCHCONTINUACION', 'CaFchcontinuacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PIEZAS', 'CaPiezas', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PESO', 'CaPeso', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VOLUMEN', 'CaVolumen', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DOCTRANSPORTE', 'CaDoctransporte', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDNAVE', 'CaIdnave', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DOCMASTER', 'CaDocmaster', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EQUIPOS', 'CaEquipos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_HORASALIDA', 'CaHorasalida', 'TIME', false, null);

		$tMap->addColumn('CA_HORALLEGADA', 'CaHorallegada', 'TIME', false, null);

		$tMap->addForeignKey('CA_IDETAPA', 'CaIdetapa', 'VARCHAR', 'tb_tracking_etapas', 'CA_IDETAPA', false, null);

		$tMap->addColumn('CA_PROPIEDADES', 'CaPropiedades', 'VARCHAR', false, null);

	} 
} 