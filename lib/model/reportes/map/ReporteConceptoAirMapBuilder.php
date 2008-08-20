<?php


	
class ReporteConceptoAirMapBuilder {

	
	const CLASS_NAME = 'lib.model.reportes.map.ReporteConceptoAirMapBuilder';	

    
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
		
		$tMap = $this->dbMap->addTable('tb_repaereo');
		$tMap->setPhpName('ReporteConceptoAir');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('OID', 'Oid', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('CA_IDREPORTE', 'CaIdreporte', 'int', CreoleTypes::INTEGER, 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addForeignKey('CA_IDCONCEPTO', 'CaIdconcepto', 'int', CreoleTypes::INTEGER, 'tb_conceptos', 'CA_IDCONCEPTO', true, null);

		$tMap->addColumn('CA_REPORTAR_TAR', 'CaReportarTar', 'double', CreoleTypes::NUMERIC, true);

		$tMap->addColumn('CA_REPORTAR_MIN', 'CaReportarMin', 'double', CreoleTypes::NUMERIC, true);

		$tMap->addColumn('CA_REPORTAR_IDM', 'CaReportarIdm', 'string', CreoleTypes::VARCHAR, true, 3);

		$tMap->addColumn('CA_COBRAR_TAR', 'CaCobrarTar', 'double', CreoleTypes::NUMERIC, true);

		$tMap->addColumn('CA_COBRAR_MIN', 'CaCobrarMin', 'double', CreoleTypes::NUMERIC, true);

		$tMap->addColumn('CA_COBRAR_IDM', 'CaCobrarIdm', 'string', CreoleTypes::VARCHAR, true, 3);
				
    } 
} 