<?php

/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * Description of NuevoProveedorForm
 *
 * @author abotero
 */
class NuevoProveedorForm extends BaseForm {

    public function configure() {
        sfValidatorBase::setCharset('ISO-8859-1');

        $widgets = array();
        $validator = array();
        
        $empresa=sfConfig::get('app_branding_name');
        
        $idempresa = array();
        if($empresa=='TPLogistics')
            $idempresa[]=array(7,0,0);
        else
            $idempresa = array(1,2,8);

        $q = Doctrine_Query::create()
                ->from("IdsTipo t")
                ->where("t.ca_aplicacion = ? ", "Proveedores")
                ->addOrderBy("t.ca_nombre");
        $widgets['tipo_proveedor'] = new sfWidgetFormDoctrineChoice(array('model' => 'IdsTipo', 'add_empty' => false, 'query' => $q), array("onChange" => "changeTipo()"));

        $widgets['critico'] = new sfWidgetFormInputCheckbox();
        
        $q = Doctrine_Query::create()->select("p.ca_valor")->from("Parametro p")->where("p.ca_casouso=?", "CU229")
                ->addOrderBy("p.ca_identificacion");
        $widgets['controladoporsig'] = new sfWidgetFormDoctrineChoice(array("model" => "Parametro",
            'add_empty' => false,
            'query' => $q,
            'method' => "getCaValor",
            'key_method' => "getCaIdentificacion"),array("onChange" => "habilitar()"));
        $widgets['aprobado'] = new sfWidgetFormExtDate(array(),array("disabled"=>"true"));
        $widgets['fchvencimiento'] = new sfWidgetFormExtDate();
        $widgets['activo_impo'] = new sfWidgetFormInputCheckbox();
        $widgets['activo_expo'] = new sfWidgetFormInputCheckbox();
        $widgets['vetado'] = new sfWidgetFormInputCheckbox();
        $widgets['sigla'] = new sfWidgetFormInputText();
        $widgets['transporte'] = new sfWidgetFormChoice(array('choices' => array("" => "",
                Constantes::AEREO => Constantes::AEREO,
                Constantes::MARITIMO => Constantes::MARITIMO,
                Constantes::TERRESTRE => Constantes::TERRESTRE,
                "Agencia" => "Agencia"
        )));

        $root = Doctrine::getTable("MaestraClasificacion")
                        ->createQuery("mc")
                        ->select('mc.ca_idclasificacion, mc.ca_nombre')
                        ->addWhere('mc.ca_tipo = ?', 'proveedor')
                        ->addWhere('mc.ca_estado = ?', 'A')
                        ->addWhere('mc.ca_idpadre = ?', 0)
                        ->addOrderBy("mc.ca_nombre")
                        ->fetchOne();
        
        $tree = array();
        $childs = $root->getChilds();
        foreach ($childs as $child) {
            $subarray = array();
            $branchs  = $child->getChilds();
            foreach ($branchs as $branch) {
                $subBrns = $branch->getChilds();
                foreach ($subBrns as $subBrn) {
                    $subarray[$subBrn->getCaIdclasificacion()] = $subBrn->getCaNombre();
                }
                $tree[$child->getCaNombre() . ' - ' . $branch->getCaNombre()] = $subarray;
            }
            
        }
        $widgets['idclasificacion'] = new sfWidgetFormChoice(array('choices' => $tree));
        
        $widgets['empresa'] = new sfWidgetFormChoice(array('choices' => array("Todas" => "Todas",
                Constantes::COLTRANS => Constantes::COLTRANS,
                Constantes::COLMAS => Constantes::COLMAS,
                Constantes::COLOTM => Constantes::COLOTM
        )));
        $widgets['contrato_comodato'] = new sfWidgetFormInputCheckbox();

        $widgets['ant_legales'] = new sfWidgetFormTextarea(array(), array("size" => 80, "style" => "width: 300px; height: 50px;"));
        $widgets['ant_penales'] = new sfWidgetFormTextarea(array(), array("size" => 80, "style" => "width: 300px; height: 50px;"));
        $widgets['ant_financieros'] = new sfWidgetFormTextarea(array(), array("size" => 80, "style" => "width: 300px; height: 50px;"));
        
        
        $q = Doctrine::getTable("Usuario")
                        ->createQuery("u")
                        ->select('u.ca_login, j.ca_nombre, j.ca_cargo, c.ca_idempresa')
                        ->innerJoin('u.Cargo c')
                        ->innerJoin('c.Empresa e')
                        ->addWhere('u.ca_activo = ?', true)
                        ->addWhere('e.ca_idempresa IN (?,?,?)', $idempresa)
                        ->addWhere('c.ca_manager= ?', true)
                        ->orWhere('u.ca_departamento = ?', 'Pricing')
                        ->addOrderBy("u.ca_nombre");
                                    
        $widgets['jefecuenta'] = new sfWidgetFormDoctrineChoice(array('model' => 'Usuario', 
            'add_empty' => false, 
            'query' => $q,
            'method' => "getCaNombre",
            'key_method' => "getCaLogin",
            'add_empty'=> true));
      

        $this->setWidgets($widgets);


        $validator["tipo_proveedor"] = new sfValidatorString(array('required' => true), array('required' => 'El tipo de proveedor es requerido'));

        $validator["critico"] = new sfValidatorBoolean(array('required' => false), array('required' => 'Este campo es requerido'));

        /* $validator["esporadico"] =new sfValidatorBoolean( array('required' => false ),
          array('required' => 'Este campo es requerido')); */


        $validator["controladoporsig"] = new sfValidatorInteger(array('required' => false), array('required' => 'Este campo es requerido'));

        $validator["aprobado"] = new sfValidatorDate(array('required' => false), array('required' => 'Este campo es requerido'));
        $validator["fchvencimiento"] = new sfValidatorDate(array('required' => false));


        $validator["activo_impo"] = new sfValidatorBoolean(array('required' => false));
        $validator["activo_expo"] = new sfValidatorBoolean(array('required' => false));
        $validator["vetado"] = new sfValidatorBoolean(array('required' => false));

        $validator["transporte"] = new sfValidatorString(array('required' => false), array('required' => 'El transporte es requerido'));
        $validator["sigla"] = new sfValidatorString(array('required' => false));

        $validator["empresa"] = new sfValidatorString(array('required' => false));
        $validator["idclasificacion"] = new sfValidatorString(array('required' => false));
        $validator["jefecuenta"] = new sfValidatorString(array('required' => false));

        $validator["contrato_comodato"] = new sfValidatorBoolean(array('required' => false));
        $validator["ant_legales"] = new sfValidatorString(array('required' => false));
        $validator["ant_penales"] = new sfValidatorString(array('required' => false));
        $validator["ant_financieros"] = new sfValidatorString(array('required' => false));

        $this->setValidators($validator);
    }

}

?>
