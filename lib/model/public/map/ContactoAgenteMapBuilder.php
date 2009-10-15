<?php



class ContactoAgenteMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.ContactoAgenteMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ContactoAgentePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ContactoAgentePeer::TABLE_NAME);
		$tMap->setPhpName('ContactoAgente');
		$tMap->setClassname('ContactoAgente');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_contactos_id');

		$tMap->addPrimaryKey('CA_IDCONTACTO', 'CaIdcontacto', 'VARCHAR', true, null);

		$tMap->addForeignKey('CA_IDAGENTE', 'CaIdagente', 'INTEGER', 'vi_agentes', 'CA_IDAGENTE', false, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addColumn('CA_APELLIDO', 'CaApellido', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DIRECCION', 'CaDireccion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDCIUDAD', 'CaIdciudad', 'VARCHAR', 'tb_ciudades', 'CA_IDCIUDAD', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CARGO', 'CaCargo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DETALLE', 'CaDetalle', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SUGERIDO', 'CaSugerido', 'BOOLEAN', false, null);

		$tMap->addColumn('CA_ACTIVO', 'CaActivo', 'BOOLEAN', false, null);

	} 
} 