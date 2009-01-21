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
class ClienteMapBuilder implements MapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap(ClientePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ClientePeer::TABLE_NAME);
		$tMap->setPhpName('Cliente');
		$tMap->setClassname('Cliente');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_clientes_ca_idcliente_seq');

		$tMap->addPrimaryKey('CA_IDCLIENTE', 'CaIdcliente', 'INTEGER', true, null);

		$tMap->addColumn('CA_DIGITO', 'CaDigito', 'INTEGER', false, null);

		$tMap->addColumn('CA_COMPANIA', 'CaCompania', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PAPELLIDO', 'CaPapellido', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SAPELLIDO', 'CaSapellido', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NOMBRES', 'CaNombres', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SALUDO', 'CaSaludo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SEXO', 'CaSexo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CUMPLEANOS', 'CaCumpleanos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OFICINA', 'CaOficina', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VENDEDOR', 'CaVendedor', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addColumn('CA_COORDINADOR', 'CaCoordinador', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DIRECCION', 'CaDireccion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_LOCALIDAD', 'CaLocalidad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_COMPLEMENTO', 'CaComplemento', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PREFERENCIAS', 'CaPreferencias', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONFIRMAR', 'CaConfirmar', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDCIUDAD', 'CaIdciudad', 'VARCHAR', 'tb_ciudades', 'CA_IDCIUDAD', false, null);

		$tMap->addColumn('CA_IDGRUPO', 'CaIdgrupo', 'INTEGER', false, null);

		$tMap->addColumn('CA_LISTACLINTON', 'CaListaclinton', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCIRCULAR', 'CaFchcircular', 'DATE', false, null);

	} // doBuild()

} // ClienteMapBuilder
