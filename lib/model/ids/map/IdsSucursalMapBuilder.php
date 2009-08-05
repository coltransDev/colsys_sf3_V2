<?php



class IdsSucursalMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.ids.map.IdsSucursalMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(IdsSucursalPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsSucursalPeer::TABLE_NAME);
		$tMap->setPhpName('IdsSucursal');
		$tMap->setClassname('IdsSucursal');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('ids.tb_sucursales_id');

		$tMap->addPrimaryKey('CA_IDSUCURSAL', 'CaIdsucursal', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_ID', 'CaId', 'INTEGER', 'ids.tb_ids', 'CA_ID', false, null);

		$tMap->addColumn('CA_PRINCIPAL', 'CaPrincipal', 'BOOLEAN', false, null);

		$tMap->addColumn('CA_DIRECCION', 'CaDireccion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OFICINA', 'CaOficina', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TORRE', 'CaTorre', 'INTEGER', false, null);

		$tMap->addColumn('CA_BLOQUE', 'CaBloque', 'VARCHAR', false, null);

		$tMap->addColumn('CA_INTERIOR', 'CaInterior', 'VARCHAR', false, null);

		$tMap->addColumn('CA_LOCALIDAD', 'CaLocalidad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_COMPLEMENTO', 'CaComplemento', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDCIUDAD', 'CaIdciudad', 'VARCHAR', 'tb_ciudades', 'CA_IDCIUDAD', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', true, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} 
} 