<?php


/**
 * This class adds structure of 'tb_repaduanadet' table to 'propel' DatabaseMap object.
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
class RepCostoMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.reportes.map.RepCostoMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(RepCostoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RepCostoPeer::TABLE_NAME);
		$tMap->setPhpName('RepCosto');
		$tMap->setClassname('RepCosto');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('OID', 'Oid', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER', 'tb_reportes', 'CA_IDREPORTE', true, null);

		$tMap->addForeignKey('CA_IDCOSTO', 'CaIdcosto', 'INTEGER', 'tb_costos', 'CA_IDCOSTO', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', true, null);

		$tMap->addColumn('CA_VLRCOSTO', 'CaVlrcosto', 'NUMERIC', true, null);

		$tMap->addColumn('CA_MINCOSTO', 'CaMincosto', 'NUMERIC', false, null);

		$tMap->addColumn('CA_NETCOSTO', 'CaNetcosto', 'NUMERIC', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DETALLES', 'CaDetalles', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'DATE', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} // doBuild()

} // RepCostoMapBuilder
