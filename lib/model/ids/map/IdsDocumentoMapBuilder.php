<?php



class IdsDocumentoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.ids.map.IdsDocumentoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(IdsDocumentoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsDocumentoPeer::TABLE_NAME);
		$tMap->setPhpName('IdsDocumento');
		$tMap->setClassname('IdsDocumento');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('ids.tb_documentos_id');

		$tMap->addPrimaryKey('CA_IDDOCUMENTO', 'CaIddocumento', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_ID', 'CaId', 'INTEGER', 'ids.tb_ids', 'CA_ID', true, null);

		$tMap->addForeignKey('CA_IDTIPO', 'CaIdtipo', 'INTEGER', 'ids.tb_tipodocumentos', 'CA_IDTIPO', true, null);

		$tMap->addColumn('CA_UBICACION', 'CaUbicacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHINICIO', 'CaFchinicio', 'DATE', true, null);

		$tMap->addColumn('CA_FCHVENCIMIENTO', 'CaFchvencimiento', 'DATE', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', true, null);

	} 
} 