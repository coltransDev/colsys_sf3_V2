<?php


	
class FalaInstructionsMapBuilder {

	
	const CLASS_NAME = 'lib.model.falabella.map.FalaInstructionsMapBuilder';	

    
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
		
		$tMap = $this->dbMap->addTable('tb_falainstructions');
		$tMap->setPhpName('FalaInstructions');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignKey('CA_IDDOC', 'CaIddoc', 'string', CreoleTypes::VARCHAR, 'tb_falaheader', 'CA_IDDOC', true, null);

		$tMap->addColumn('CA_INSTRUCTIONS', 'CaInstructions', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addPrimaryKey('CA_IDFALAINSTRUCTIONS', 'CaIdfalainstructions', 'int', CreoleTypes::INTEGER, true, null);
				
    } 
} 