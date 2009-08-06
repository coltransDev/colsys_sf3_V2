<?php



class TransportistaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.TransportistaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TransportistaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TransportistaPeer::TABLE_NAME);
		$tMap->setPhpName('Transportista');
		$tMap->setClassname('Transportista');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_transportistas_ca_idtransportista_seq');

		$tMap->addPrimaryKey('CA_IDTRANSPORTISTA', 'CaIdtransportista', 'INTEGER', true, null);

		$tMap->addColumn('CA_DIGITO', 'CaDigito', 'NUMERIC', false, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DIRECCION', 'CaDireccion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDCIUDAD', 'CaIdciudad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_WEBSITE', 'CaWebsite', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

	} 
} 