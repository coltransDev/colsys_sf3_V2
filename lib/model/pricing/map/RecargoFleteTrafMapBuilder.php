<?php


/**
 * This class adds structure of 'tb_recargosxtraf' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.pricing.map
 */
class RecargoFleteTrafMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.pricing.map.RecargoFleteTrafMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(RecargoFleteTrafPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RecargoFleteTrafPeer::TABLE_NAME);
		$tMap->setPhpName('RecargoFleteTraf');
		$tMap->setClassname('RecargoFleteTraf');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDTRAFICO', 'CaIdtrafico', 'VARCHAR', true, null);

		$tMap->addPrimaryKey('CA_IDCIUDAD', 'CaIdciudad', 'VARCHAR', true, null);

		$tMap->addForeignPrimaryKey('CA_IDRECARGO', 'CaIdrecargo', 'INTEGER' , 'tb_tiporecargo', 'CA_IDRECARGO', true, null);

		$tMap->addColumn('CA_APLICACION', 'CaAplicacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VLRFIJO', 'CaVlrfijo', 'NUMERIC', false, null);

		$tMap->addColumn('CA_PORCENTAJE', 'CaPorcentaje', 'NUMERIC', false, null);

		$tMap->addColumn('CA_BASEPORCENTAJE', 'CaBaseporcentaje', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VLRUNITARIO', 'CaVlrunitario', 'NUMERIC', false, null);

		$tMap->addColumn('CA_BASEUNITARIO', 'CaBaseunitario', 'VARCHAR', false, null);

		$tMap->addColumn('CA_RECARGOMINIMO', 'CaRecargominimo', 'NUMERIC', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHINICIO', 'CaFchinicio', 'DATE', false, null);

		$tMap->addColumn('CA_FCHVENCIMIENTO', 'CaFchvencimiento', 'DATE', false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

	} // doBuild()

} // RecargoFleteTrafMapBuilder
