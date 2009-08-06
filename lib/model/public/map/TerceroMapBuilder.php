<?php



class TerceroMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.TerceroMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TerceroPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TerceroPeer::TABLE_NAME);
		$tMap->setPhpName('Tercero');
		$tMap->setClassname('Tercero');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_terceros_ca_idtercero_seq');

		$tMap->addPrimaryKey('CA_IDTERCERO', 'CaIdtercero', 'INTEGER', true, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTACTO', 'CaContacto', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DIRECCION', 'CaDireccion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDCIUDAD', 'CaIdciudad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VENDEDOR', 'CaVendedor', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDENTIFICACION', 'CaIdentificacion', 'VARCHAR', false, null);

	} 
} 