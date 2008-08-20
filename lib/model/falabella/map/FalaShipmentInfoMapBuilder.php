<?php


/**
 * This class adds structure of 'tb_falashipmentinfo' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.falabella.map
 */
class FalaShipmentInfoMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.falabella.map.FalaShipmentInfoMapBuilder';

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

		$tMap = $this->dbMap->addTable('tb_falashipmentinfo');
		$tMap->setPhpName('FalaShipmentInfo');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDDOC', 'CaIddoc', 'string' , CreoleTypes::VARCHAR, 'tb_falaheader', 'CA_IDDOC', true, null);

		$tMap->addColumn('CA_BEGIN_WINDOW', 'CaBeginWindow', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_END_WINDOW', 'CaEndWindow', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_COMMODITIES', 'CaCommodities', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PARTIAL', 'CaPartial', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PAYMENT_TERMS', 'CaPaymentTerms', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_INCOTERMS', 'CaIncoterms', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CONTAINER_TYPE', 'CaContainerType', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_UTV', 'CaUtv', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ETV', 'CaEtv', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_LINE', 'CaLine', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CONTACT_LINE', 'CaContactLine', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CONTACT_IMPORTER', 'CaContactImporter', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_UPPO', 'CaUppo', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_EB', 'CaEb', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_EDD', 'CaEdd', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PORT', 'CaPort', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TRANSSHIPMENT', 'CaTransshipment', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TRANSSHIPMENT_PORT', 'CaTransshipmentPort', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_SHIPPING_ORG', 'CaShippingOrg', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ORIGINAL_ORG', 'CaOriginalOrg', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FWD_COPY_ORG', 'CaFwdCopyOrg', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCR_ORG', 'CaFcrOrg', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_SHIPPING_DST', 'CaShippingDst', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ORIGINAL_DST', 'CaOriginalDst', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FWD_COPY_DST', 'CaFwdCopyDst', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCR_DST', 'CaFcrDst', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TRANSPORT_VIA', 'CaTransportVia', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_INVOICE_ORG', 'CaInvoiceOrg', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PACKING_LIST_ORG', 'CaPackingListOrg', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DOCUMENT_ORG', 'CaDocumentOrg', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OC_ORG', 'CaOcOrg', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OTHERS_DOCS_ORG', 'CaOthersDocsOrg', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_INVOICE_CPS', 'CaInvoiceCps', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PACKING_LIST_CPS', 'CaPackingListCps', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DOCUMENT_CPS', 'CaDocumentCps', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OC_CPS', 'CaOcCps', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OTHERS_DOCS_CPS', 'CaOthersDocsCps', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FINAL_PORT', 'CaFinalPort', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ALTER_PORT', 'CaAlterPort', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_LIMIT_DATE', 'CaLimitDate', 'int', CreoleTypes::DATE, false, null);

	} // doBuild()

} // FalaShipmentInfoMapBuilder
