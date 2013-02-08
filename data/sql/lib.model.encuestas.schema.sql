CREATE TABLE encuestas.tb_formulario (ca_id SERIAL, ca_titulo VARCHAR(255) NOT NULL, ca_alias VARCHAR(255), ca_introduccion TEXT, ca_activo BOOLEAN DEFAULT 'true', ca_vigencia_inicial TIMESTAMP, ca_vigencia_final TIMESTAMP, ca_token VARCHAR(255), ca_nombre_formato VARCHAR(255), ca_color VARCHAR(8), ca_bold VARCHAR(8), ca_strong VARCHAR(8), ca_fchcreado TIMESTAMP NOT NULL, ca_usucreado VARCHAR(20) NOT NULL, ca_fchactualizado TIMESTAMP, ca_usuactualizado VARCHAR(20), PRIMARY KEY(ca_id));
CREATE TABLE encuestas.tb_bloque (ca_id SERIAL, ca_idformulario INT NOT NULL, ca_titulo VARCHAR(250) NOT NULL, ca_introduccion TEXT, ca_orden INT, ca_activo BOOLEAN DEFAULT 'true', ca_color VARCHAR(45), ca_tipo VARCHAR(45) DEFAULT '0', ca_fchcreado TIMESTAMP NOT NULL, ca_usucreado VARCHAR(20) NOT NULL, ca_fchactualizado TIMESTAMP, ca_usuactualizado VARCHAR(20), PRIMARY KEY(ca_id));
CREATE TABLE encuestas.tb_pregunta (ca_id SERIAL, ca_idbloque INT NOT NULL, ca_texto TEXT NOT NULL, ca_error VARCHAR(200), ca_ayuda VARCHAR(45), ca_obligatoria BOOLEAN, ca_tipo INT, ca_orden INT, ca_activo BOOLEAN DEFAULT 'true', ca_numeracion BOOLEAN, ca_intervalo_inicial INT, ca_intervalo_final INT, ca_etiqueta_intervalo_inicial VARCHAR(45), ca_etiqueta_intervalo_final VARCHAR(45), ca_etiquetas_columnas TEXT, ca_etiquetas_filas TEXT, ca_fchcreado TIMESTAMP NOT NULL, ca_usucreado VARCHAR(20) NOT NULL, ca_fchactualizado TIMESTAMP, ca_usuactualizado VARCHAR(20), PRIMARY KEY(ca_id));
CREATE TABLE encuestas.tb_opcion (ca_id SERIAL, ca_idpregunta INT NOT NULL, ca_texto VARCHAR(55) NOT NULL, ca_orden INT, ca_default BOOLEAN DEFAULT 'false', ca_fchcreado TIMESTAMP NOT NULL, ca_usucreado VARCHAR(20) NOT NULL, ca_fchactualizado TIMESTAMP, ca_usuactualizado VARCHAR(20), PRIMARY KEY(ca_id));

CREATE INDEX fki_tb_formulario_tb_bloque ON encuestas.tb_bloque (ca_idformulario);
CREATE INDEX fki_tb_formulario_tb_bloque_tb_pregunta ON encuestas.tb_pregunta (ca_idbloque);
CREATE INDEX fki_tb_formulario_tb_bloque_tb_pregunta_tb_opcion ON encuestas.tb_opcion (ca_idpregunta);

ALTER TABLE encuestas.tb_bloque ADD CONSTRAINT tb_bloque_FK_1 FOREIGN KEY (ca_idformulario) REFERENCES encuestas.tb_formulario(ca_id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE encuestas.tb_pregunta ADD CONSTRAINT tb_pregunta_FK_2  FOREIGN KEY (ca_idbloque) REFERENCES encuestas.tb_bloque(ca_id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE encuestas.tb_opcion ADD CONSTRAINT tb_opcion_FK_3  FOREIGN KEY (ca_idpregunta) REFERENCES encuestas.tb_pregunta(ca_id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;



CREATE TABLE encuestas.tb_control_encuesta (ca_id SERIAL, ca_idformulario INT NOT NULL, ca_idempresa INT NOT NULL, ca_tipo_contestador SMALLINT, ca_id_contestador INT, ca_idvalueservicio INT NOT NULL, ca_servicio SMALLINT, ca_fchcreado TIMESTAMP, ca_usucreado VARCHAR(20), ca_fchactualizado TIMESTAMP, ca_usuactualizado VARCHAR(20), PRIMARY KEY(ca_id));
CREATE TABLE encuestas.tb_resultado_encuesta (ca_id SERIAL, ca_idpregunta INT NOT NULL, ca_resultado VARCHAR(1000), ca_idcontrolencuesta INT NOT NULL, PRIMARY KEY(ca_id));

CREATE INDEX fki_tb_control_encuesta_tb_formulario ON encuestas.tb_control_encuesta (ca_idformulario);
CREATE INDEX fki_tb_resultado_encuesta_tb_control_encuesta ON encuestas.tb_resultado_encuesta (ca_idcontrolencuesta);
CREATE INDEX fki_tb_resultado_encuesta_tb_pregunta ON encuestas.tb_resultado_encuesta (ca_idpregunta);
CREATE INDEX fki_tb_control_encuesta_tb_empresa ON encuestas.tb_control_encuesta (ca_idempresa);

ALTER TABLE encuestas.tb_control_encuesta ADD CONSTRAINT tb_control_encuesta_FK_1 FOREIGN KEY (ca_idformulario) REFERENCES encuestas.tb_formulario(ca_id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE encuestas.tb_control_encuesta ADD CONSTRAINT tb_control_encuesta_FK_2 FOREIGN KEY (ca_idempresa) REFERENCES control.tb_empresas(ca_idempresa) NOT DEFERRABLE INITIALLY IMMEDIATE;

ALTER TABLE encuestas.tb_resultado_encuesta ADD CONSTRAINT tb_resultado_encuesta_FK_1 FOREIGN KEY (ca_idcontrolencuesta) REFERENCES encuestas.tb_control_encuesta(ca_id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE encuestas.tb_resultado_encuesta ADD CONSTRAINT tb_resultado_encuesta_FK_2 FOREIGN KEY (ca_idpregunta) REFERENCES encuestas.tb_pregunta(ca_id) NOT DEFERRABLE INITIALLY IMMEDIATE;

//CREATE INDEX fki_tb_resultado_encuesta_tb_config_values ON encuestas.tb_resultado_encuesta (ca_idvaluepregunta);

