<?php


/**
 * This class adds structure of 'tb_clientes' table to 'propel' DatabaseMap object.
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
class ClienteMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.ClienteMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_clientes');
		$tMap->setPhpName('Cliente');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_clientes_SEQ');

		$tMap->addPrimaryKey('CA_IDCLIENTE', 'CaIdcliente', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CA_DIGITO', 'CaDigito', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CA_COMPANIA', 'CaCompania', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PAPELLIDO', 'CaPapellido', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_SAPELLIDO', 'CaSapellido', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_NOMBRES', 'CaNombres', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_SALUDO', 'CaSaludo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_SEXO', 'CaSexo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CUMPLEANOS', 'CaCumpleanos', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OFICINA', 'CaOficina', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_VENDEDOR', 'CaVendedor', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_COORDINADOR', 'CaCoordinador', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DIRECCION', 'CaDireccion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_LOCALIDAD', 'CaLocalidad', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_COMPLEMENTO', 'CaComplemento', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PREFERENCIAS', 'CaPreferencias', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CONFIRMAR', 'CaConfirmar', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('CA_IDCIUDAD', 'CaIdciudad', 'string', CreoleTypes::VARCHAR, 'tb_ciudades', 'CA_IDCIUDAD', false, null);

		$tMap->addColumn('CA_IDGRUPO', 'CaIdgrupo', 'int', CreoleTypes::INTEGER, false, null);

	} // doBuild()

} // ClienteMapBuilder
