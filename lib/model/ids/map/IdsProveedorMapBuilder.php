<?php



class IdsProveedorMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.ids.map.IdsProveedorMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(IdsProveedorPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsProveedorPeer::TABLE_NAME);
		$tMap->setPhpName('IdsProveedor');
		$tMap->setClassname('IdsProveedor');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDPROVEEDOR', 'CaIdproveedor', 'INTEGER' , 'ids.tb_ids', 'CA_ID', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'INTEGER', true, null);

		$tMap->addColumn('CA_CRITICO', 'CaCritico', 'BOOLEAN', true, null);

		$tMap->addColumn('CA_CONTROLADOPORSIG', 'CaControladoporsig', 'BOOLEAN', true, null);

		$tMap->addColumn('CA_FCHAPROBADO', 'CaFchaprobado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUAPROBADO', 'CaUsuaprobado', 'VARCHAR', false, null);

	} 
} 