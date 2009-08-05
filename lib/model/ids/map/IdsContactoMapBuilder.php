<?php



class IdsContactoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.ids.map.IdsContactoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(IdsContactoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsContactoPeer::TABLE_NAME);
		$tMap->setPhpName('IdsContacto');
		$tMap->setClassname('IdsContacto');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDCONTACTO', 'CaIdcontacto', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDSUCURSAL', 'CaIdsucursal', 'INTEGER', 'ids.tb_sucursales', 'CA_IDSUCURSAL', true, null);

		$tMap->addColumn('CA_NOMBRES', 'CaNombres', 'VARCHAR', true, null);

		$tMap->addColumn('CA_PAPELLIDO', 'CaPapellido', 'VARCHAR', true, null);

		$tMap->addColumn('CA_SAPELLIDO', 'CaSapellido', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SALUDO', 'CaSaludo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DIRECCION', 'CaDireccion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CARGO', 'CaCargo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DEPARTAMENTO', 'CaDepartamento', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SUGERIDO', 'CaSugerido', 'BOOLEAN', false, null);

		$tMap->addColumn('CA_ACTIVO', 'CaActivo', 'BOOLEAN', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', true, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', true, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHELIMINADO', 'CaFcheliminado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUELIMINADO', 'CaUsueliminado', 'VARCHAR', false, null);

	} 
} 