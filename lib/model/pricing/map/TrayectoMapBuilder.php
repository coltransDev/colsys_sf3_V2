<?php



class TrayectoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.pricing.map.TrayectoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TrayectoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TrayectoPeer::TABLE_NAME);
		$tMap->setPhpName('Trayecto');
		$tMap->setClassname('Trayecto');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('OID', 'Oid', 'INTEGER', true, null);

		$tMap->addPrimaryKey('CA_IDTRAYECTO', 'CaIdtrayecto', 'INTEGER', true, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'VARCHAR', true, 8);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'VARCHAR', true, 8);

		$tMap->addForeignKey('CA_IDLINEA', 'CaIdlinea', 'INTEGER', 'vi_transporlineas', 'CA_IDLINEA', true, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', true, null);

		$tMap->addColumn('CA_TERMINAL', 'CaTerminal', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FRECUENCIA', 'CaFrecuencia', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TIEMPOTRANSITO', 'CaTiempotransito', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'DATE', false, null);

		$tMap->addColumn('CA_IDTARIFAS', 'CaIdtarifas', 'INTEGER', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDAGENTE', 'CaIdagente', 'INTEGER', 'tb_agentes', 'CA_IDAGENTE', false, null);

		$tMap->addColumn('CA_ACTIVO', 'CaActivo', 'BOOLEAN', false, null);

	} 
} 