<?php


	
class TarFletesMapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.TarFletesMapBuilder';	

    
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
		
		$tMap = $this->dbMap->addTable('tb_fletes');
		$tMap->setPhpName('TarFletes');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('OID', 'Oid', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CA_IDTRAYECTO', 'CaIdtrayecto', 'int', CreoleTypes::INTEGER, true);

		$tMap->addColumn('CA_IDCONCEPTO', 'CaIdconcepto', 'int', CreoleTypes::INTEGER, true);

		$tMap->addColumn('CA_VLRNETO', 'CaVlrneto', 'double', CreoleTypes::NUMERIC, true);

		$tMap->addColumn('CA_VLRMINIMO', 'CaVlrminimo', 'double', CreoleTypes::NUMERIC, false);

		$tMap->addColumn('CA_VLRSENIOR', 'CaVlrsenior', 'double', CreoleTypes::NUMERIC, false);

		$tMap->addColumn('CA_VLRJUNIOR', 'CaVlrjunior', 'double', CreoleTypes::NUMERIC, false);

		$tMap->addColumn('CA_FLETEMINIMO', 'CaFleteminimo', 'double', CreoleTypes::NUMERIC, false);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'string', CreoleTypes::VARCHAR, false, 3);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::TIMESTAMP, false);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'int', CreoleTypes::TIMESTAMP, false);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHINICIO', 'CaFchinicio', 'int', CreoleTypes::DATE, false);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'int', CreoleTypes::DATE, false);
				
    } 
} 