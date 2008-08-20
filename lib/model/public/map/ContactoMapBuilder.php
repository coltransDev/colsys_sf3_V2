<?php


/**
 * This class adds structure of 'tb_concliente' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.public.map
 */
class ContactoMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.ContactoMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_concliente');
		$tMap->setPhpName('Contacto');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDCONTACTO', 'CaIdcontacto', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('CA_IDCLIENTE', 'CaIdcliente', 'int', CreoleTypes::INTEGER, 'tb_clientes', 'CA_IDCLIENTE', true, null);

		$tMap->addColumn('CA_PAPELLIDO', 'CaPapellido', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_SAPELLIDO', 'CaSapellido', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_NOMBRES', 'CaNombres', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_SALUDO', 'CaSaludo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CARGO', 'CaCargo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DEPARTAMENTO', 'CaDepartamento', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CUMPLEANOS', 'CaCumpleanos', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // ContactoMapBuilder
