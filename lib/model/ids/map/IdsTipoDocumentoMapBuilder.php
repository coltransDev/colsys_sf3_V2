<?php



class IdsTipoDocumentoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.ids.map.IdsTipoDocumentoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(IdsTipoDocumentoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsTipoDocumentoPeer::TABLE_NAME);
		$tMap->setPhpName('IdsTipoDocumento');
		$tMap->setClassname('IdsTipoDocumento');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('ids.tb_tipodocumentos_id');

		$tMap->addPrimaryKey('CA_IDTIPO', 'CaIdtipo', 'INTEGER', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_EQUIVALENTEA', 'CaEquivalentea', 'INTEGER', false, null);

		$tMap->addColumn('CA_VIGENCIA', 'CaVigencia', 'VARCHAR', true, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', true, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', true, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} 
} 