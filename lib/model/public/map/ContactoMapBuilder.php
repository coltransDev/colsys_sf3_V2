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
class ContactoMapBuilder implements MapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap(ContactoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ContactoPeer::TABLE_NAME);
		$tMap->setPhpName('Contacto');
		$tMap->setClassname('Contacto');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDCONTACTO', 'CaIdcontacto', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDCLIENTE', 'CaIdcliente', 'INTEGER', 'tb_clientes', 'CA_IDCLIENTE', true, null);

		$tMap->addColumn('CA_PAPELLIDO', 'CaPapellido', 'VARCHAR', true, null);

		$tMap->addColumn('CA_SAPELLIDO', 'CaSapellido', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NOMBRES', 'CaNombres', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SALUDO', 'CaSaludo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CARGO', 'CaCargo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DEPARTAMENTO', 'CaDepartamento', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'DATE', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CUMPLEANOS', 'CaCumpleanos', 'VARCHAR', false, null);

	} // doBuild()

} // ContactoMapBuilder
