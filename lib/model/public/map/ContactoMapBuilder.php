<?php



class ContactoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.ContactoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ContactoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ContactoPeer::TABLE_NAME);
		$tMap->setPhpName('Contacto');
		$tMap->setClassname('Contacto');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDCONTACTO', 'CaIdcontacto', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDCLIENTE', 'CaIdcliente', 'INTEGER', 'tb_clientes', 'CA_IDCLIENTE', true, null);

		$tMap->addColumn('CA_PAPELLIDO', 'CaPapellido', 'VARCHAR', true, null);

		$tMap->addColumn('CA_SAPELLIDO', 'CaSapellido', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NOMBRES', 'CaNombres', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SALUDO', 'CaSaludo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CARGO', 'CaCargo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DEPARTAMENTO', 'CaDepartamento', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'DATE', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CUMPLEANOS', 'CaCumpleanos', 'VARCHAR', false, null);

	} 
} 