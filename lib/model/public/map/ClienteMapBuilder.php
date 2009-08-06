<?php



class ClienteMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.ClienteMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ClientePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ClientePeer::TABLE_NAME);
		$tMap->setPhpName('Cliente');
		$tMap->setClassname('Cliente');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_clientes_ca_idcliente_seq');

		$tMap->addPrimaryKey('CA_IDCLIENTE', 'CaIdcliente', 'INTEGER', true, null);

		$tMap->addColumn('CA_DIGITO', 'CaDigito', 'INTEGER', false, null);

		$tMap->addColumn('CA_COMPANIA', 'CaCompania', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PAPELLIDO', 'CaPapellido', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SAPELLIDO', 'CaSapellido', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NOMBRES', 'CaNombres', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SALUDO', 'CaSaludo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SEXO', 'CaSexo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CUMPLEANOS', 'CaCumpleanos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OFICINA', 'CaOficina', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VENDEDOR', 'CaVendedor', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addColumn('CA_COORDINADOR', 'CaCoordinador', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DIRECCION', 'CaDireccion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_LOCALIDAD', 'CaLocalidad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_COMPLEMENTO', 'CaComplemento', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PREFERENCIAS', 'CaPreferencias', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONFIRMAR', 'CaConfirmar', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDCIUDAD', 'CaIdciudad', 'VARCHAR', 'tb_ciudades', 'CA_IDCIUDAD', false, null);

		$tMap->addColumn('CA_IDGRUPO', 'CaIdgrupo', 'INTEGER', false, null);

		$tMap->addColumn('CA_LISTACLINTON', 'CaListaclinton', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCIRCULAR', 'CaFchcircular', 'DATE', false, null);

		$tMap->addColumn('CA_STATUS', 'CaStatus', 'VARCHAR', false, null);

	} 
} 