<?php


	
class SeaReporteMapBuilder {

	
	const CLASS_NAME = 'lib.model.sea.map.SeaReporteMapBuilder';	

    
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
		$this->dbMap = Propel::getDatabaseMap('propel');
		
		$tMap = $this->dbMap->addTable('tb_reportes');
		$tMap->setPhpName('SeaReporte');

		$tMap->setUseIdGenerator(true);
 
		$tMap->setPrimaryKeyMethodInfo('tb_reportes_SEQ');

		$tMap->addPrimaryKey('CA_IDREPORTE', 'CaIdreporte', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CA_IDCONSIGNATARIO', 'CaIdconsignatario', 'int', CreoleTypes::INTEGER, false);

		$tMap->addColumn('CA_CONSECUTIVO', 'CaConsecutivo', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('CA_VERSION', 'CaVersion', 'int', CreoleTypes::INTEGER, false);

		$tMap->addColumn('CA_FCHREPORTE', 'CaFchreporte', 'int', CreoleTypes::DATE, false);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHDESPACHO', 'CaFchdespacho', 'int', CreoleTypes::DATE, false);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('CA_IDLINEA', 'CaIdlinea', 'int', CreoleTypes::INTEGER, 'tb_transporlineas', 'CA_IDLINEA', false, null);

		$tMap->addColumn('CA_IDBODEGA', 'CaIdbodega', 'int', CreoleTypes::INTEGER, false);

		$tMap->addColumn('CA_IDPROVEEDOR', 'CaIdproveedor', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_COLMAS', 'CaColmas', 'string', CreoleTypes::VARCHAR, false, null);
				
    } 
} 