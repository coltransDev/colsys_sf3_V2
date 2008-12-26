<?php

/**
 * Base static class for performing query and update operations on the 'tb_falashipmentinfo' table.
 *
 * 
 *
 * @package    lib.model.falabella.om
 */
abstract class BaseFalaShipmentInfoPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_falashipmentinfo';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.falabella.FalaShipmentInfo';

	/** The total number of columns. */
	const NUM_COLUMNS = 41;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_IDDOC field */
	const CA_IDDOC = 'tb_falashipmentinfo.CA_IDDOC';

	/** the column name for the CA_BEGIN_WINDOW field */
	const CA_BEGIN_WINDOW = 'tb_falashipmentinfo.CA_BEGIN_WINDOW';

	/** the column name for the CA_END_WINDOW field */
	const CA_END_WINDOW = 'tb_falashipmentinfo.CA_END_WINDOW';

	/** the column name for the CA_COMMODITIES field */
	const CA_COMMODITIES = 'tb_falashipmentinfo.CA_COMMODITIES';

	/** the column name for the CA_PARTIAL field */
	const CA_PARTIAL = 'tb_falashipmentinfo.CA_PARTIAL';

	/** the column name for the CA_PAYMENT_TERMS field */
	const CA_PAYMENT_TERMS = 'tb_falashipmentinfo.CA_PAYMENT_TERMS';

	/** the column name for the CA_INCOTERMS field */
	const CA_INCOTERMS = 'tb_falashipmentinfo.CA_INCOTERMS';

	/** the column name for the CA_CONTAINER_TYPE field */
	const CA_CONTAINER_TYPE = 'tb_falashipmentinfo.CA_CONTAINER_TYPE';

	/** the column name for the CA_UTV field */
	const CA_UTV = 'tb_falashipmentinfo.CA_UTV';

	/** the column name for the CA_ETV field */
	const CA_ETV = 'tb_falashipmentinfo.CA_ETV';

	/** the column name for the CA_LINE field */
	const CA_LINE = 'tb_falashipmentinfo.CA_LINE';

	/** the column name for the CA_CONTACT_LINE field */
	const CA_CONTACT_LINE = 'tb_falashipmentinfo.CA_CONTACT_LINE';

	/** the column name for the CA_CONTACT_IMPORTER field */
	const CA_CONTACT_IMPORTER = 'tb_falashipmentinfo.CA_CONTACT_IMPORTER';

	/** the column name for the CA_UPPO field */
	const CA_UPPO = 'tb_falashipmentinfo.CA_UPPO';

	/** the column name for the CA_EB field */
	const CA_EB = 'tb_falashipmentinfo.CA_EB';

	/** the column name for the CA_EDD field */
	const CA_EDD = 'tb_falashipmentinfo.CA_EDD';

	/** the column name for the CA_PORT field */
	const CA_PORT = 'tb_falashipmentinfo.CA_PORT';

	/** the column name for the CA_TRANSSHIPMENT field */
	const CA_TRANSSHIPMENT = 'tb_falashipmentinfo.CA_TRANSSHIPMENT';

	/** the column name for the CA_TRANSSHIPMENT_PORT field */
	const CA_TRANSSHIPMENT_PORT = 'tb_falashipmentinfo.CA_TRANSSHIPMENT_PORT';

	/** the column name for the CA_SHIPPING_ORG field */
	const CA_SHIPPING_ORG = 'tb_falashipmentinfo.CA_SHIPPING_ORG';

	/** the column name for the CA_ORIGINAL_ORG field */
	const CA_ORIGINAL_ORG = 'tb_falashipmentinfo.CA_ORIGINAL_ORG';

	/** the column name for the CA_FWD_COPY_ORG field */
	const CA_FWD_COPY_ORG = 'tb_falashipmentinfo.CA_FWD_COPY_ORG';

	/** the column name for the CA_FCR_ORG field */
	const CA_FCR_ORG = 'tb_falashipmentinfo.CA_FCR_ORG';

	/** the column name for the CA_SHIPPING_DST field */
	const CA_SHIPPING_DST = 'tb_falashipmentinfo.CA_SHIPPING_DST';

	/** the column name for the CA_ORIGINAL_DST field */
	const CA_ORIGINAL_DST = 'tb_falashipmentinfo.CA_ORIGINAL_DST';

	/** the column name for the CA_FWD_COPY_DST field */
	const CA_FWD_COPY_DST = 'tb_falashipmentinfo.CA_FWD_COPY_DST';

	/** the column name for the CA_FCR_DST field */
	const CA_FCR_DST = 'tb_falashipmentinfo.CA_FCR_DST';

	/** the column name for the CA_TRANSPORT_VIA field */
	const CA_TRANSPORT_VIA = 'tb_falashipmentinfo.CA_TRANSPORT_VIA';

	/** the column name for the CA_INVOICE_ORG field */
	const CA_INVOICE_ORG = 'tb_falashipmentinfo.CA_INVOICE_ORG';

	/** the column name for the CA_PACKING_LIST_ORG field */
	const CA_PACKING_LIST_ORG = 'tb_falashipmentinfo.CA_PACKING_LIST_ORG';

	/** the column name for the CA_DOCUMENT_ORG field */
	const CA_DOCUMENT_ORG = 'tb_falashipmentinfo.CA_DOCUMENT_ORG';

	/** the column name for the CA_OC_ORG field */
	const CA_OC_ORG = 'tb_falashipmentinfo.CA_OC_ORG';

	/** the column name for the CA_OTHERS_DOCS_ORG field */
	const CA_OTHERS_DOCS_ORG = 'tb_falashipmentinfo.CA_OTHERS_DOCS_ORG';

	/** the column name for the CA_INVOICE_CPS field */
	const CA_INVOICE_CPS = 'tb_falashipmentinfo.CA_INVOICE_CPS';

	/** the column name for the CA_PACKING_LIST_CPS field */
	const CA_PACKING_LIST_CPS = 'tb_falashipmentinfo.CA_PACKING_LIST_CPS';

	/** the column name for the CA_DOCUMENT_CPS field */
	const CA_DOCUMENT_CPS = 'tb_falashipmentinfo.CA_DOCUMENT_CPS';

	/** the column name for the CA_OC_CPS field */
	const CA_OC_CPS = 'tb_falashipmentinfo.CA_OC_CPS';

	/** the column name for the CA_OTHERS_DOCS_CPS field */
	const CA_OTHERS_DOCS_CPS = 'tb_falashipmentinfo.CA_OTHERS_DOCS_CPS';

	/** the column name for the CA_FINAL_PORT field */
	const CA_FINAL_PORT = 'tb_falashipmentinfo.CA_FINAL_PORT';

	/** the column name for the CA_ALTER_PORT field */
	const CA_ALTER_PORT = 'tb_falashipmentinfo.CA_ALTER_PORT';

	/** the column name for the CA_LIMIT_DATE field */
	const CA_LIMIT_DATE = 'tb_falashipmentinfo.CA_LIMIT_DATE';

	/**
	 * An identiy map to hold any loaded instances of FalaShipmentInfo objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array FalaShipmentInfo[]
	 */
	public static $instances = array();

	/**
	 * The MapBuilder instance for this peer.
	 * @var        MapBuilder
	 */
	private static $mapBuilder = null;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc', 'CaBeginWindow', 'CaEndWindow', 'CaCommodities', 'CaPartial', 'CaPaymentTerms', 'CaIncoterms', 'CaContainerType', 'CaUtv', 'CaEtv', 'CaLine', 'CaContactLine', 'CaContactImporter', 'CaUppo', 'CaEb', 'CaEdd', 'CaPort', 'CaTransshipment', 'CaTransshipmentPort', 'CaShippingOrg', 'CaOriginalOrg', 'CaFwdCopyOrg', 'CaFcrOrg', 'CaShippingDst', 'CaOriginalDst', 'CaFwdCopyDst', 'CaFcrDst', 'CaTransportVia', 'CaInvoiceOrg', 'CaPackingListOrg', 'CaDocumentOrg', 'CaOcOrg', 'CaOthersDocsOrg', 'CaInvoiceCps', 'CaPackingListCps', 'CaDocumentCps', 'CaOcCps', 'CaOthersDocsCps', 'CaFinalPort', 'CaAlterPort', 'CaLimitDate', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIddoc', 'caBeginWindow', 'caEndWindow', 'caCommodities', 'caPartial', 'caPaymentTerms', 'caIncoterms', 'caContainerType', 'caUtv', 'caEtv', 'caLine', 'caContactLine', 'caContactImporter', 'caUppo', 'caEb', 'caEdd', 'caPort', 'caTransshipment', 'caTransshipmentPort', 'caShippingOrg', 'caOriginalOrg', 'caFwdCopyOrg', 'caFcrOrg', 'caShippingDst', 'caOriginalDst', 'caFwdCopyDst', 'caFcrDst', 'caTransportVia', 'caInvoiceOrg', 'caPackingListOrg', 'caDocumentOrg', 'caOcOrg', 'caOthersDocsOrg', 'caInvoiceCps', 'caPackingListCps', 'caDocumentCps', 'caOcCps', 'caOthersDocsCps', 'caFinalPort', 'caAlterPort', 'caLimitDate', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDDOC, self::CA_BEGIN_WINDOW, self::CA_END_WINDOW, self::CA_COMMODITIES, self::CA_PARTIAL, self::CA_PAYMENT_TERMS, self::CA_INCOTERMS, self::CA_CONTAINER_TYPE, self::CA_UTV, self::CA_ETV, self::CA_LINE, self::CA_CONTACT_LINE, self::CA_CONTACT_IMPORTER, self::CA_UPPO, self::CA_EB, self::CA_EDD, self::CA_PORT, self::CA_TRANSSHIPMENT, self::CA_TRANSSHIPMENT_PORT, self::CA_SHIPPING_ORG, self::CA_ORIGINAL_ORG, self::CA_FWD_COPY_ORG, self::CA_FCR_ORG, self::CA_SHIPPING_DST, self::CA_ORIGINAL_DST, self::CA_FWD_COPY_DST, self::CA_FCR_DST, self::CA_TRANSPORT_VIA, self::CA_INVOICE_ORG, self::CA_PACKING_LIST_ORG, self::CA_DOCUMENT_ORG, self::CA_OC_ORG, self::CA_OTHERS_DOCS_ORG, self::CA_INVOICE_CPS, self::CA_PACKING_LIST_CPS, self::CA_DOCUMENT_CPS, self::CA_OC_CPS, self::CA_OTHERS_DOCS_CPS, self::CA_FINAL_PORT, self::CA_ALTER_PORT, self::CA_LIMIT_DATE, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc', 'ca_begin_window', 'ca_end_window', 'ca_commodities', 'ca_partial', 'ca_payment_terms', 'ca_incoterms', 'ca_container_type', 'ca_utv', 'ca_etv', 'ca_line', 'ca_contact_line', 'ca_contact_importer', 'ca_uppo', 'ca_eb', 'ca_edd', 'ca_port', 'ca_transshipment', 'ca_transshipment_port', 'ca_shipping_org', 'ca_original_org', 'ca_fwd_copy_org', 'ca_fcr_org', 'ca_shipping_dst', 'ca_original_dst', 'ca_fwd_copy_dst', 'ca_fcr_dst', 'ca_transport_via', 'ca_invoice_org', 'ca_packing_list_org', 'ca_document_org', 'ca_oc_org', 'ca_others_docs_org', 'ca_invoice_cps', 'ca_packing_list_cps', 'ca_document_cps', 'ca_oc_cps', 'ca_others_docs_cps', 'ca_final_port', 'ca_alter_port', 'ca_limit_date', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc' => 0, 'CaBeginWindow' => 1, 'CaEndWindow' => 2, 'CaCommodities' => 3, 'CaPartial' => 4, 'CaPaymentTerms' => 5, 'CaIncoterms' => 6, 'CaContainerType' => 7, 'CaUtv' => 8, 'CaEtv' => 9, 'CaLine' => 10, 'CaContactLine' => 11, 'CaContactImporter' => 12, 'CaUppo' => 13, 'CaEb' => 14, 'CaEdd' => 15, 'CaPort' => 16, 'CaTransshipment' => 17, 'CaTransshipmentPort' => 18, 'CaShippingOrg' => 19, 'CaOriginalOrg' => 20, 'CaFwdCopyOrg' => 21, 'CaFcrOrg' => 22, 'CaShippingDst' => 23, 'CaOriginalDst' => 24, 'CaFwdCopyDst' => 25, 'CaFcrDst' => 26, 'CaTransportVia' => 27, 'CaInvoiceOrg' => 28, 'CaPackingListOrg' => 29, 'CaDocumentOrg' => 30, 'CaOcOrg' => 31, 'CaOthersDocsOrg' => 32, 'CaInvoiceCps' => 33, 'CaPackingListCps' => 34, 'CaDocumentCps' => 35, 'CaOcCps' => 36, 'CaOthersDocsCps' => 37, 'CaFinalPort' => 38, 'CaAlterPort' => 39, 'CaLimitDate' => 40, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIddoc' => 0, 'caBeginWindow' => 1, 'caEndWindow' => 2, 'caCommodities' => 3, 'caPartial' => 4, 'caPaymentTerms' => 5, 'caIncoterms' => 6, 'caContainerType' => 7, 'caUtv' => 8, 'caEtv' => 9, 'caLine' => 10, 'caContactLine' => 11, 'caContactImporter' => 12, 'caUppo' => 13, 'caEb' => 14, 'caEdd' => 15, 'caPort' => 16, 'caTransshipment' => 17, 'caTransshipmentPort' => 18, 'caShippingOrg' => 19, 'caOriginalOrg' => 20, 'caFwdCopyOrg' => 21, 'caFcrOrg' => 22, 'caShippingDst' => 23, 'caOriginalDst' => 24, 'caFwdCopyDst' => 25, 'caFcrDst' => 26, 'caTransportVia' => 27, 'caInvoiceOrg' => 28, 'caPackingListOrg' => 29, 'caDocumentOrg' => 30, 'caOcOrg' => 31, 'caOthersDocsOrg' => 32, 'caInvoiceCps' => 33, 'caPackingListCps' => 34, 'caDocumentCps' => 35, 'caOcCps' => 36, 'caOthersDocsCps' => 37, 'caFinalPort' => 38, 'caAlterPort' => 39, 'caLimitDate' => 40, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDDOC => 0, self::CA_BEGIN_WINDOW => 1, self::CA_END_WINDOW => 2, self::CA_COMMODITIES => 3, self::CA_PARTIAL => 4, self::CA_PAYMENT_TERMS => 5, self::CA_INCOTERMS => 6, self::CA_CONTAINER_TYPE => 7, self::CA_UTV => 8, self::CA_ETV => 9, self::CA_LINE => 10, self::CA_CONTACT_LINE => 11, self::CA_CONTACT_IMPORTER => 12, self::CA_UPPO => 13, self::CA_EB => 14, self::CA_EDD => 15, self::CA_PORT => 16, self::CA_TRANSSHIPMENT => 17, self::CA_TRANSSHIPMENT_PORT => 18, self::CA_SHIPPING_ORG => 19, self::CA_ORIGINAL_ORG => 20, self::CA_FWD_COPY_ORG => 21, self::CA_FCR_ORG => 22, self::CA_SHIPPING_DST => 23, self::CA_ORIGINAL_DST => 24, self::CA_FWD_COPY_DST => 25, self::CA_FCR_DST => 26, self::CA_TRANSPORT_VIA => 27, self::CA_INVOICE_ORG => 28, self::CA_PACKING_LIST_ORG => 29, self::CA_DOCUMENT_ORG => 30, self::CA_OC_ORG => 31, self::CA_OTHERS_DOCS_ORG => 32, self::CA_INVOICE_CPS => 33, self::CA_PACKING_LIST_CPS => 34, self::CA_DOCUMENT_CPS => 35, self::CA_OC_CPS => 36, self::CA_OTHERS_DOCS_CPS => 37, self::CA_FINAL_PORT => 38, self::CA_ALTER_PORT => 39, self::CA_LIMIT_DATE => 40, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc' => 0, 'ca_begin_window' => 1, 'ca_end_window' => 2, 'ca_commodities' => 3, 'ca_partial' => 4, 'ca_payment_terms' => 5, 'ca_incoterms' => 6, 'ca_container_type' => 7, 'ca_utv' => 8, 'ca_etv' => 9, 'ca_line' => 10, 'ca_contact_line' => 11, 'ca_contact_importer' => 12, 'ca_uppo' => 13, 'ca_eb' => 14, 'ca_edd' => 15, 'ca_port' => 16, 'ca_transshipment' => 17, 'ca_transshipment_port' => 18, 'ca_shipping_org' => 19, 'ca_original_org' => 20, 'ca_fwd_copy_org' => 21, 'ca_fcr_org' => 22, 'ca_shipping_dst' => 23, 'ca_original_dst' => 24, 'ca_fwd_copy_dst' => 25, 'ca_fcr_dst' => 26, 'ca_transport_via' => 27, 'ca_invoice_org' => 28, 'ca_packing_list_org' => 29, 'ca_document_org' => 30, 'ca_oc_org' => 31, 'ca_others_docs_org' => 32, 'ca_invoice_cps' => 33, 'ca_packing_list_cps' => 34, 'ca_document_cps' => 35, 'ca_oc_cps' => 36, 'ca_others_docs_cps' => 37, 'ca_final_port' => 38, 'ca_alter_port' => 39, 'ca_limit_date' => 40, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new FalaShipmentInfoMapBuilder();
		}
		return self::$mapBuilder;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. FalaShipmentInfoPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(FalaShipmentInfoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_IDDOC);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_BEGIN_WINDOW);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_END_WINDOW);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_COMMODITIES);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_PARTIAL);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_PAYMENT_TERMS);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_INCOTERMS);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_CONTAINER_TYPE);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_UTV);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_ETV);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_LINE);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_CONTACT_LINE);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_CONTACT_IMPORTER);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_UPPO);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_EB);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_EDD);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_PORT);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_TRANSSHIPMENT);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_TRANSSHIPMENT_PORT);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_SHIPPING_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_ORIGINAL_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_FWD_COPY_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_FCR_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_SHIPPING_DST);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_ORIGINAL_DST);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_FWD_COPY_DST);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_FCR_DST);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_TRANSPORT_VIA);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_INVOICE_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_PACKING_LIST_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_DOCUMENT_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_OC_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_OTHERS_DOCS_ORG);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_INVOICE_CPS);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_PACKING_LIST_CPS);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_DOCUMENT_CPS);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_OC_CPS);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_OTHERS_DOCS_CPS);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_FINAL_PORT);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_ALTER_PORT);

		$criteria->addSelectColumn(FalaShipmentInfoPeer::CA_LIMIT_DATE);

	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(FalaShipmentInfoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FalaShipmentInfoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     FalaShipmentInfo
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = FalaShipmentInfoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return FalaShipmentInfoPeer::populateObjects(FalaShipmentInfoPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			FalaShipmentInfoPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      FalaShipmentInfo $value A FalaShipmentInfo object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(FalaShipmentInfo $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIddoc();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A FalaShipmentInfo object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof FalaShipmentInfo) {
				$key = (string) $value->getCaIddoc();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or FalaShipmentInfo object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     FalaShipmentInfo Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = FalaShipmentInfoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = FalaShipmentInfoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = FalaShipmentInfoPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				FalaShipmentInfoPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related FalaHeader table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinFalaHeader(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(FalaShipmentInfoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FalaShipmentInfoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FalaShipmentInfoPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of FalaShipmentInfo objects pre-filled with their FalaHeader objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of FalaShipmentInfo objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinFalaHeader(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FalaShipmentInfoPeer::addSelectColumns($c);
		$startcol = (FalaShipmentInfoPeer::NUM_COLUMNS - FalaShipmentInfoPeer::NUM_LAZY_LOAD_COLUMNS);
		FalaHeaderPeer::addSelectColumns($c);

		$c->addJoin(array(FalaShipmentInfoPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FalaShipmentInfoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FalaShipmentInfoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = FalaShipmentInfoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FalaShipmentInfoPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = FalaHeaderPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = FalaHeaderPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = FalaHeaderPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					FalaHeaderPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (FalaShipmentInfo) to $obj2 (FalaHeader)
				$obj2->setFalaShipmentInfo($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(FalaShipmentInfoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FalaShipmentInfoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FalaShipmentInfoPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}

	/**
	 * Selects a collection of FalaShipmentInfo objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of FalaShipmentInfo objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FalaShipmentInfoPeer::addSelectColumns($c);
		$startcol2 = (FalaShipmentInfoPeer::NUM_COLUMNS - FalaShipmentInfoPeer::NUM_LAZY_LOAD_COLUMNS);

		FalaHeaderPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (FalaHeaderPeer::NUM_COLUMNS - FalaHeaderPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(FalaShipmentInfoPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FalaShipmentInfoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FalaShipmentInfoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = FalaShipmentInfoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FalaShipmentInfoPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined FalaHeader rows

			$key2 = FalaHeaderPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = FalaHeaderPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = FalaHeaderPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					FalaHeaderPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (FalaShipmentInfo) to the collection in $obj2 (FalaHeader)
				$obj1->setFalaHeader($obj2);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array();
  }
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * This uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return FalaShipmentInfoPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a FalaShipmentInfo or Criteria object.
	 *
	 * @param      mixed $values Criteria or FalaShipmentInfo object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from FalaShipmentInfo object
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a FalaShipmentInfo or Criteria object.
	 *
	 * @param      mixed $values Criteria or FalaShipmentInfo object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(FalaShipmentInfoPeer::CA_IDDOC);
			$selectCriteria->add(FalaShipmentInfoPeer::CA_IDDOC, $criteria->remove(FalaShipmentInfoPeer::CA_IDDOC), $comparison);

		} else { // $values is FalaShipmentInfo object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_falashipmentinfo table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(FalaShipmentInfoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a FalaShipmentInfo or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or FalaShipmentInfo object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			FalaShipmentInfoPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof FalaShipmentInfo) {
			// invalidate the cache for this single object
			FalaShipmentInfoPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FalaShipmentInfoPeer::CA_IDDOC, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				FalaShipmentInfoPeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given FalaShipmentInfo object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      FalaShipmentInfo $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(FalaShipmentInfo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FalaShipmentInfoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FalaShipmentInfoPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(FalaShipmentInfoPeer::DATABASE_NAME, FalaShipmentInfoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FalaShipmentInfoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      string $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     FalaShipmentInfo
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = FalaShipmentInfoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(FalaShipmentInfoPeer::DATABASE_NAME);
		$criteria->add(FalaShipmentInfoPeer::CA_IDDOC, $pk);

		$v = FalaShipmentInfoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(FalaShipmentInfoPeer::DATABASE_NAME);
			$criteria->add(FalaShipmentInfoPeer::CA_IDDOC, $pks, Criteria::IN);
			$objs = FalaShipmentInfoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseFalaShipmentInfoPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the FalaShipmentInfoPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the FalaShipmentInfoPeer class:
//
// Propel::getDatabaseMap(FalaShipmentInfoPeer::DATABASE_NAME)->addTableBuilder(FalaShipmentInfoPeer::TABLE_NAME, FalaShipmentInfoPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseFalaShipmentInfoPeer::DATABASE_NAME)->addTableBuilder(BaseFalaShipmentInfoPeer::TABLE_NAME, BaseFalaShipmentInfoPeer::getMapBuilder());

