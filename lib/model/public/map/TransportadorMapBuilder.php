<?php



class TransportadorMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.TransportadorMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TransportadorPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TransportadorPeer::TABLE_NAME);
		$tMap->setPhpName('Transportador');
		$tMap->setClassname('Transportador');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_transporlineas_ca_idlinea_seq');

		$tMap->addPrimaryKey('CA_IDLINEA', 'CaIdlinea', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDTRANSPORTISTA', 'CaIdtransportista', 'NUMERIC', 'tb_transportistas', 'CA_IDTRANSPORTISTA', false, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SIGLA', 'CaSigla', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', false, null);

	} 
} 