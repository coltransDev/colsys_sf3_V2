<?php


/**
 * This class adds structure of 'tb_inomaestra_air' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.air.map
 */
class InoMaestraAirMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.air.map.InoMaestraAirMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(InoMaestraAirPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(InoMaestraAirPeer::TABLE_NAME);
		$tMap->setPhpName('InoMaestraAir');
		$tMap->setClassname('InoMaestraAir');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CA_FCHREFERENCIA', 'CaFchreferencia', 'DATE', true, null);

		$tMap->addPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'VARCHAR', true, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDLINEA', 'CaIdlinea', 'INTEGER', 'tb_transporlineas', 'CA_IDLINEA', false, null);

		$tMap->addColumn('CA_MAWB', 'CaMawb', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PIEZAS', 'CaPiezas', 'INTEGER', false, null);

		$tMap->addColumn('CA_PESO', 'CaPeso', 'NUMERIC', false, null);

		$tMap->addColumn('CA_PESOVOLUMEN', 'CaPesovolumen', 'NUMERIC', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHPREAVISO', 'CaFchpreaviso', 'DATE', false, null);

		$tMap->addColumn('CA_FCHLLEGADA', 'CaFchllegada', 'DATE', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'DATE', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHLIQUIDADO', 'CaFchliquidado', 'DATE', false, null);

		$tMap->addColumn('CA_USULIQUIDADO', 'CaUsuliquidado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCERRADO', 'CaFchcerrado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCERRADO', 'CaUsucerrado', 'VARCHAR', false, null);

	} // doBuild()

} // InoMaestraAirMapBuilder
