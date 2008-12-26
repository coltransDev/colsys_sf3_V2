<?php


/**
 * This class adds structure of 'tb_recargos' table to 'propel' DatabaseMap object.
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
class RecargoFleteMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.pricing.map.RecargoFleteMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(RecargoFletePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(RecargoFletePeer::TABLE_NAME);
		$tMap->setPhpName('RecargoFlete');
		$tMap->setClassname('RecargoFlete');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDTRAYECTO', 'CaIdtrayecto', 'INTEGER' , 'tb_fletes', 'CA_IDTRAYECTO', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER' , 'tb_fletes', 'CA_IDCONCEPTO', true, null);

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

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} // doBuild()

} // RecargoFleteMapBuilder
