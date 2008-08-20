
-----------------------------------------------------------------------------
-- tb_falaheader
-----------------------------------------------------------------------------

DROP TABLE "tb_falaheader" CASCADE;


CREATE TABLE "tb_falaheader"
(
	"ca_iddoc" VARCHAR  NOT NULL,
	"ca_fecha_carpeta" DATE,
	"ca_archivo_origen" VARCHAR,
	"ca_reporte" VARCHAR,
	"ca_num_viaje" VARCHAR,
	"ca_cod_carrier" VARCHAR,
	"ca_codigo_puerto_pickup" VARCHAR,
	"ca_codigo_puerto_descarga" VARCHAR,
	"ca_container_mode" VARCHAR,
	"ca_nombre_proveedor" VARCHAR,
	"ca_campo_59" VARCHAR,
	"ca_codigo_proveedor" VARCHAR,
	"ca_campo_61" VARCHAR,
	"ca_monto_invoice_miles" NUMERIC,
	"ca_procesado" BOOLEAN,
	"ca_trader" VARCHAR,
	"ca_vendor_id" VARCHAR,
	"ca_vendor_name" VARCHAR,
	"ca_vendor_addr1" VARCHAR,
	"ca_vendor_city" VARCHAR,
	"ca_vendor_country" VARCHAR,
	"ca_esd" DATE,
	"ca_lsd" DATE,
	"ca_incoterms" VARCHAR,
	"ca_payment_terms" VARCHAR,
	"ca_proforma_number" VARCHAR,
	"ca_origin" VARCHAR,
	"ca_destination" VARCHAR,
	"ca_trans_ship_port" VARCHAR,
	"ca_reqd_delivery" DATE,
	"ca_orden_comments" VARCHAR,
	"ca_manufacturer_contact" VARCHAR,
	"ca_manufacturer_phone" VARCHAR,
	"ca_manufacturer_fax" VARCHAR,
	PRIMARY KEY ("ca_iddoc")
);

COMMENT ON TABLE "tb_falaheader" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- tb_faladetails
-----------------------------------------------------------------------------

DROP TABLE "tb_faladetails" CASCADE;


CREATE TABLE "tb_faladetails"
(
	"ca_iddoc" VARCHAR  NOT NULL,
	"ca_sku" VARCHAR  NOT NULL,
	"ca_vpn" VARCHAR,
	"ca_num_cont_part1" VARCHAR,
	"ca_num_cont_part2" VARCHAR,
	"ca_num_cont_sell" VARCHAR,
	"ca_container_iso" VARCHAR,
	"ca_cantidad_miles" INTEGER,
	"ca_unidad_medidad_cantidad" VARCHAR,
	"ca_descripcion_item" VARCHAR,
	"ca_cantidad_paquetes_miles" NUMERIC,
	"ca_unidad_medida_paquetes" VARCHAR,
	"ca_cantidad_volumen_miles" NUMERIC,
	"ca_unidad_medida_volumen" VARCHAR,
	"ca_cantidad_peso_miles" NUMERIC,
	"ca_unidad_medida_peso" VARCHAR,
	PRIMARY KEY ("ca_iddoc","ca_sku")
);

COMMENT ON TABLE "tb_faladetails" IS '';


SET search_path TO public;
ALTER TABLE "tb_faladetails" ADD CONSTRAINT "tb_faladetails_FK_1" FOREIGN KEY ("ca_iddoc") REFERENCES "tb_falaheader" ("ca_iddoc");

-----------------------------------------------------------------------------
-- tb_falainstructions
-----------------------------------------------------------------------------

DROP TABLE "tb_falainstructions" CASCADE;


CREATE TABLE "tb_falainstructions"
(
	"ca_iddoc" VARCHAR  NOT NULL,
	"ca_instructions" VARCHAR,
	"ca_idfalainstructions" INTEGER  NOT NULL,
	PRIMARY KEY ("ca_idfalainstructions")
);

COMMENT ON TABLE "tb_falainstructions" IS '';


SET search_path TO public;
ALTER TABLE "tb_falainstructions" ADD CONSTRAINT "tb_falainstructions_FK_1" FOREIGN KEY ("ca_iddoc") REFERENCES "tb_falaheader" ("ca_iddoc");

-----------------------------------------------------------------------------
-- tb_falashipmentinfo
-----------------------------------------------------------------------------

DROP TABLE "tb_falashipmentinfo" CASCADE;


CREATE TABLE "tb_falashipmentinfo"
(
	"ca_iddoc" VARCHAR  NOT NULL,
	"ca_begin_window" DATE,
	"ca_end_window" DATE,
	"ca_commodities" VARCHAR,
	"ca_partial" VARCHAR,
	"ca_payment_terms" VARCHAR,
	"ca_incoterms" VARCHAR,
	"ca_container_type" VARCHAR,
	"ca_utv" VARCHAR,
	"ca_etv" VARCHAR,
	"ca_line" VARCHAR,
	"ca_contact_line" VARCHAR,
	"ca_contact_importer" VARCHAR,
	"ca_uppo" NUMERIC,
	"ca_eb" VARCHAR,
	"ca_edd" VARCHAR,
	"ca_port" VARCHAR,
	"ca_transshipment" VARCHAR,
	"ca_transshipment_port" VARCHAR,
	"ca_shipping_org" VARCHAR,
	"ca_original_org" VARCHAR,
	"ca_fwd_copy_org" VARCHAR,
	"ca_fcr_org" VARCHAR,
	"ca_shipping_dst" VARCHAR,
	"ca_original_dst" VARCHAR,
	"ca_fwd_copy_dst" VARCHAR,
	"ca_fcr_dst" VARCHAR,
	"ca_transport_via" VARCHAR,
	"ca_invoice_org" VARCHAR,
	"ca_packing_list_org" VARCHAR,
	"ca_document_org" VARCHAR,
	"ca_oc_org" VARCHAR,
	"ca_others_docs_org" VARCHAR,
	"ca_invoice_cps" VARCHAR,
	"ca_packing_list_cps" VARCHAR,
	"ca_document_cps" VARCHAR,
	"ca_oc_cps" VARCHAR,
	"ca_others_docs_cps" VARCHAR,
	"ca_final_port" VARCHAR,
	"ca_alter_port" VARCHAR,
	"ca_limit_date" DATE,
	PRIMARY KEY ("ca_iddoc")
);

COMMENT ON TABLE "tb_falashipmentinfo" IS '';


SET search_path TO public;
ALTER TABLE "tb_falashipmentinfo" ADD CONSTRAINT "tb_falashipmentinfo_FK_1" FOREIGN KEY ("ca_iddoc") REFERENCES "tb_falaheader" ("ca_iddoc");
