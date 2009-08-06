<?php



class ColNovedadMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.ColNovedadMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ColNovedadPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ColNovedadPeer::TABLE_NAME);
		$tMap->setPhpName('ColNovedad');
		$tMap->setClassname('ColNovedad');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_colnovedades_id');

		$tMap->addPrimaryKey('CA_IDNOVEDAD', 'CaIdnovedad', 'INTEGER', true, null);

		$tMap->addColumn('CA_FCHPUBLICACION', 'CaFchpublicacion', 'DATE', false, null);

		$tMap->addColumn('CA_ASUNTO', 'CaAsunto', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DETALLE', 'CaDetalle', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHARCHIVAR', 'CaFcharchivar', 'DATE', false, null);

		$tMap->addColumn('CA_EXTENSION', 'CaExtension', 'VARCHAR', false, null);

		$tMap->addColumn('CA_HEADER_FILE', 'CaHeaderFile', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTENT', 'CaContent', 'BLOB', false, null);

		$tMap->addColumn('CA_FCHPUBLICADO', 'CaFchpublicado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUPUBLICADO', 'CaUsupublicado', 'VARCHAR', false, null);

	} 
} 