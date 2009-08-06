<?php



class TrackingUserLogMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.public.map.TrackingUserLogMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(TrackingUserLogPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(TrackingUserLogPeer::TABLE_NAME);
		$tMap->setPhpName('TrackingUserLog');
		$tMap->setClassname('TrackingUserLog');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_tracking_users_log_id');

		$tMap->addPrimaryKey('CA_ID', 'CaId', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_EMAIL', 'CaEmail', 'VARCHAR', 'tb_tracking_users', 'CA_EMAIL', false, null);

		$tMap->addColumn('CA_FCHEVENTO', 'CaFchevento', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_URL', 'CaUrl', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EVENTO', 'CaEvento', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IPADDRESS', 'CaIpaddress', 'VARCHAR', false, null);

		$tMap->addColumn('CA_USERAGENT', 'CaUseragent', 'VARCHAR', false, null);

	} 
} 