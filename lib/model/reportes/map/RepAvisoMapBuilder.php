<?php


/**
 * This class adds structure of 'tb_repavisos' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.reportes.map
 */
class RepAvisoMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.reportes.map.RepAvisoMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('tb_repavisos');
		$tMap->setPhpName('RepAviso');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDREPORTE', 'CaIdreporte', 'int' , CreoleTypes::INTEGER, 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addForeignPrimaryKey('CA_IDEMAIL', 'CaIdemail', 'int' , CreoleTypes::INTEGER, 'tb_emails', 'CA_IDEMAIL', true, null);

		$tMap->addColumn('CA_INTRODUCCION', 'CaIntroduccion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHSALIDA', 'CaFchsalida', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_FCHLLEGADA', 'CaFchllegada', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_FCHCONTINUACION', 'CaFchcontinuacion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PIEZAS', 'CaPiezas', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PESO', 'CaPeso', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_VOLUMEN', 'CaVolumen', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHENVIO', 'CaFchenvio', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUENVIO', 'CaUsuenvio', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DOCTRANSPORTE', 'CaDoctransporte', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IDNAVE', 'CaIdnave', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_NOTAS', 'CaNotas', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ETAPA', 'CaEtapa', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DOCMASTER', 'CaDocmaster', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_EQUIPOS', 'CaEquipos', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_HORASALIDA', 'CaHorasalida', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // RepAvisoMapBuilder
