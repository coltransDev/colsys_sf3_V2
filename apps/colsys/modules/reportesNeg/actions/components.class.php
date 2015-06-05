<?php

/**
 * clientes components.
 * @package    colsys
 * @subpackage reportes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reportesNegComponents extends sfComponents {

    public function executeMainPanel() {
        
    }

    public function load_category() {
        $this->impoexpo = $this->getRequestParameter("impoexpo");

        if ($this->impoexpo == Constantes::IMPO || utf8_decode($this->impoexpo) == Constantes::IMPO) {
            $this->impoexpo = Constantes::IMPO;
            $this->modo = $this->getRequestParameter("modo");
            if ($this->modo == Constantes::AEREO || utf8_decode($this->modo) == Constantes::AEREO) {
                $this->modo = Constantes::AEREO;
                $this->idcategory = "31";
            } else if ($this->modo == Constantes::MARITIMO || utf8_decode($this->modo) == Constantes::MARITIMO) {
                $this->modo = Constantes::MARITIMO;
                $this->idcategory = "32";
            }
        } else if ($this->impoexpo == Constantes::EXPO || utf8_decode($this->impoexpo) == Constantes::EXPO) {
            $this->impoexpo = Constantes::EXPO;
            $this->modo = $this->getRequestParameter("modo");
            if ($this->modo == Constantes::AEREO || utf8_decode($this->modo) == Constantes::AEREO) {
                $this->modo = Constantes::AEREO;
                $this->idcategory = "34";
            } else if ($this->modo == Constantes::MARITIMO || utf8_decode($this->modo) == Constantes::MARITIMO) {
                $this->modo = Constantes::MARITIMO;
                $this->idcategory = "35";
            } else if ($this->modo == Constantes::TRIANGULACION || utf8_decode($this->modo) == Constantes::TRIANGULACION) {
                $this->modo = Constantes::TRIANGULACION;
                $this->idcategory = "35";
            }
        } else if ($this->impoexpo == Constantes::TRIANGULACION || utf8_decode($this->impoexpo) == Constantes::TRIANGULACION) {
            $this->impoexpo = Constantes::TRIANGULACION;
            $this->modo = $this->getRequestParameter("modo");
            if ($this->modo == Constantes::AEREO || utf8_decode($this->modo) == Constantes::AEREO) {
                $this->modo = Constantes::AEREO;
                $this->idcategory = "31";
            } else if ($this->modo == Constantes::MARITIMO || utf8_decode($this->modo) == Constantes::MARITIMO) {
                $this->modo = Constantes::MARITIMO;
                $this->idcategory = "32";
            }
        } else if ($this->impoexpo == Constantes::OTMDTA || utf8_decode($this->impoexpo) == Constantes::OTMDTA) {
            $this->impoexpo = Constantes::OTMDTA;
            $this->modo = $this->getRequestParameter("modo");
            if ($this->modo == Constantes::AEREO || utf8_decode($this->modo) == Constantes::AEREO) {
                $this->modo = Constantes::AEREO;
                $this->idcategory = "31";
            } else if ($this->modo == Constantes::MARITIMO || utf8_decode($this->modo) == Constantes::MARITIMO) {
                $this->modo = Constantes::MARITIMO;
                $this->idcategory = "32";
            } else if ($this->modo == Constantes::TERRESTRE || utf8_decode($this->modo) == Constantes::TERRESTRE) {
                $this->modo = Constantes::TERRESTRE;
                $this->idcategory = "32";
            }
        } else {
            $this->modo = $this->getRequestParameter("modo");
            if ($this->modo == Constantes::AEREO || utf8_decode($this->modo) == Constantes::AEREO) {
                $this->modo = Constantes::AEREO;
                $this->idcategory = "37";
            } else if ($this->modo == Constantes::MARITIMO || utf8_decode($this->modo) == Constantes::MARITIMO) {
                $this->modo = Constantes::MARITIMO;
                $this->idcategory = "38";
            } else if ($this->modo == Constantes::TRIANGULACION || utf8_decode($this->modo) == Constantes::TRIANGULACION) {
                $this->modo = Constantes::TRIANGULACION;
                $this->idcategory = "38";
            }
        }
    }

    /*
     * Muestra los conceptos del reporte y un formulario para agregar un nuevo registro, tambien 
     * permite editar un campo haciendo doble click en el.
     * @author: Andres Botero
     */

    public function executePanelConceptosFletes() {
        if ($this->reporte) {
            //$transporte=($this->reporte->getCaTransporte()==constantes::TERRESTRE ) ?constantes::MARITIMO:$this->reporte->getCaTransporte();
            $transporte = $this->reporte->getCaTransporte();
            $this->conceptos = Doctrine::getTable("Concepto")
                    ->createQuery("c")
                    ->select("ca_idconcepto, ca_concepto")
                    ->where("c.ca_transporte = ?", $transporte)
                    ->addWhere("c.ca_modalidad = ?", $this->reporte->getCaModalidad())
                    ->addWhere("c.ca_fcheliminado is null ")
                    ->addOrderBy("c.ca_liminferior")
                    ->addOrderBy("c.ca_concepto")
                    ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                    ->execute();

            foreach ($this->conceptos as $key => $val) {
                $this->conceptos[$key]['ca_concepto'] = utf8_encode($this->conceptos[$key]['ca_concepto']);
            }

            array_push($this->conceptos, array("ca_idconcepto" => "9999", "ca_concepto" => "Recargo general del trayecto"));

            $impoexpo = $this->reporte->getCaImpoexpo();
            if ($impoexpo == Constantes::TRIANGULACION) {
                $impoexpo = Constantes::IMPO;
            }

            $this->recargos = Doctrine::getTable("TipoRecargo")
                    ->createQuery("c")
                    ->select("ca_idrecargo as ca_idconcepto, ca_recargo as ca_concepto")
                    ->addWhere("c.ca_tipo like ? ", "%" . Constantes::RECARGO_EN_ORIGEN . "%")
                    /* ->addWhere("c.ca_impoexpo LIKE ? ", $impoexpo )
                      ->addWhere("c.ca_transporte LIKE ? ", $this->reporte->getCaTransporte() ) */
                    ->addOrderBy("c.ca_recargo")
                    ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                    ->execute();

            foreach ($this->recargos as $key => $val) {
                $this->recargos[$key]['ca_concepto'] = utf8_encode($this->recargos[$key]['ca_concepto']);
            }
            $reporte = $this->reporte;
            $user = $this->getUser();
            $this->permiso = $user->getNivelAcceso("87");
            if ($reporte->getEditable($this->permiso, $user) && !$this->comparar) {
                $this->editable = true;
            } else {
                $this->editable = false;
            }

            if ($this->reporte->getCaTransporte() == constantes::AEREO)
                $this->aplicaciones1 = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO);
            else if ($this->reporte->getCaTransporte() == constantes::TERRESTRE)
                $this->aplicaciones1 = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO);
            else
                $this->aplicaciones1 = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO);
        }
        else {
            $this->conceptos = array();
            $this->recargos = array();
        }
    }

    public function executePanelConceptosOtm() {

        if ($this->reporte) {
            //$transporte=($this->reporte->getCaTransporte()==constantes::TERRESTRE ) ?constantes::MARITIMO:$this->reporte->getCaTransporte();
            $transporte = $this->reporte->getCaTransporte();
            $this->conceptos = Doctrine::getTable("Concepto")
                    ->createQuery("c")
                    ->select("ca_idconcepto, ca_concepto")
                    ->where("c.ca_transporte = 'Terrestre'")
                    ->addWhere("c.ca_modalidad = 'OTM-DTA'")
                    ->addWhere("c.ca_fcheliminado is null ")
                    ->addOrderBy("c.ca_liminferior")
                    ->addOrderBy("c.ca_concepto")
                    ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                    ->execute();

            foreach ($this->conceptos as $key => $val) {
                $this->conceptos[$key]['ca_concepto'] = utf8_encode($this->conceptos[$key]['ca_concepto']);
            }

            array_push($this->conceptos, array("ca_idconcepto" => "9999", "ca_concepto" => "Recargo general del trayecto"));

            $impoexpo = $this->reporte->getCaImpoexpo();
            if ($impoexpo == Constantes::TRIANGULACION) {
                $impoexpo = Constantes::IMPO;
            }
            $this->recargos = Doctrine::getTable("InoConcepto")
                    ->createQuery("c")
                    ->select("ca_idconcepto, ca_concepto")
                    ->innerJoin("c.InoConceptoModalidad cm")
                    ->innerJoin("cm.Modalidad m")
                    ->addWhere("m.ca_transporte = ? ", Constantes::TERRESTRE)
                    ->addWhere("c.ca_recargootmdta = ? ", true)
                    ->addWhere("c.ca_usueliminado IS NULL")
                    ->distinct()
                    ->addOrderBy("c.ca_concepto")
                    ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                    ->execute();
            //print_r($this->recargos);
            foreach ($this->recargos as $key => $val) {
                $this->recargos[$key]['ca_concepto'] = utf8_encode($this->recargos[$key]['ca_concepto']);
            }

            $reporte = $this->reporte;
            $user = $this->getUser();
            $this->permiso = $user->getNivelAcceso("87");

            if ($reporte->getEditable($this->permiso, $user) && !$this->comparar) {
                $this->editable = true;
            } else {
                $this->editable = false;
            }

            if ($this->reporte->getCaTransporte() == constantes::AEREO)
                $this->aplicaciones1 = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO);
            else if ($this->reporte->getCaTransporte() == constantes::TERRESTRE)
                $this->aplicaciones1 = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO);
            else
                $this->aplicaciones1 = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO);
        }
        else {
            $this->conceptos = array();
            $this->recargos = array();
        }
    }

    /*
     * Muestra los conceptos del reporte y un formulario para agregar un nuevo registro, tambien
     * permite editar un campo haciendo doble click en el.
     * @author: Andres Botero
     */

    public function executePanelRecargos() {
        $this->impoexpo = $this->reporte->getCaImpoexpo();
        if ($this->impoexpo == Constantes::TRIANGULACION) {
            $impoexpo = Constantes::IMPO;
        }
        $this->recargos = Doctrine::getTable("TipoRecargo")
                ->createQuery("c")
                ->select("ca_idrecargo as ca_idconcepto, ca_recargo as ca_concepto")
                ->addWhere("c.ca_tipo like ? ", "%" . Constantes::RECARGO_LOCAL . "%")
                /* ->addWhere("c.ca_impoexpo LIKE ? ", $impoexpo )
                  ->addWhere("c.ca_transporte LIKE ? ", $this->reporte->getCaTransporte() ) */
                ->addOrderBy("c.ca_recargo")
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                ->execute();

        foreach ($this->recargos as $key => $val) {
            $this->recargos[$key]['ca_concepto'] = utf8_encode($this->recargos[$key]['ca_concepto']);
        }

        $reporte = $this->reporte;
        $user = $this->getUser();
        $this->permiso = $user->getNivelAcceso("87");
        //echo $reporte->getCaUsucreado() || $user->getUserId()!=$reporte->getCaLogin()
        if ($reporte->getEditable($this->permiso, $user) && !$this->comparar) {
            $this->editable = true;
        } else {
            $this->editable = false;
        }

        $this->aplicacionesAereo = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO);
        $this->aplicacionesMaritimo = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO);
        $this->parametros = ParametroTable::retrieveByCaso("CU071");

        if ($this->reporte->getCaTransporte() == constantes::AEREO)
            $this->aplicaciones1 = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO);
        else
            $this->aplicaciones1 = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO);
    }

    /*
     * Muestra los conceptos del reporte y un formulario para agregar un nuevo registro, tambien
     * permite editar un campo haciendo doble click en el.
     * @author: Andres Botero
     */

    public function executePanelRecargosAduana() {
        $reporte = $this->reporte;
        $user = $this->getUser();
        $this->permiso = $user->getNivelAcceso("87");

        $this->recargos = Doctrine::getTable("Costo")
                ->createQuery("c")
                ->select("DISTINCT (ca_costo) as ca_concepto ,ca_idcosto as ca_idconcepto ")
                ->addWhere("c.ca_impoexpo = ? ", "Aduanas")
                ->addOrderBy("c.ca_costo")
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                ->execute();

        foreach ($this->recargos as $key => $val) {
            $this->recargos[$key]['ca_concepto'] = utf8_encode($this->recargos[$key]['ca_concepto']);
        }

        if ($reporte->getEditable($this->permiso, $user) && !$this->comparar) {
            $this->editable = true;
        } else {
            $this->editable = false;
        }
    }

    /*
     * Vista previa de un tercero
     * @author: Andres Botero
     */

    public function executePreviewTercero() {
        $this->tercero = Doctrine::getTable("Tercero")->find($this->idtercero);
        if (!$this->tercero)
            $this->tercero = new Tercero();
    }

    /*
     * Panel principal que contiene los demas paneles
     * @author: Mauricio Quinche
     */

    public function executeFormReportePanel() {
        $this->cache = $this->getRequestParameter("cache");
        $this->user = $this->getUser();
        $this->permiso = $this->user->getNivelAcceso("87");
        $this->load_category();
//        if($this->permiso=="3")
        {
            //    $this->load_category();
//            echo $this->idcategory;
            $this->issues = Doctrine::getTable("KBTooltip")
                    ->createQuery("t")
                    ->select("t.ca_idcategory, t.ca_title, t.ca_info, t.ca_field_id")
                    ->where("t.ca_idcategory = ?", $this->idcategory)
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();
        }
    }

    /*
     * Panel principal que contiene los demas paneles
     * @author: Mauricio Quinche
     */

    public function executeFormReportePanelOtm() {

        $this->cache = $this->getRequestParameter("cache");

        $this->user = $this->getUser();
        $this->permiso = $this->user->getNivelAcceso("87");
        $this->load_category();
//        if($this->permiso=="3")
        {
            //    $this->load_category();
//            echo $this->idcategory;
            $this->issues = Doctrine::getTable("KBTooltip")
                    ->createQuery("t")
                    ->select("t.ca_idcategory, t.ca_title, t.ca_info, t.ca_field_id")
                    ->where("t.ca_idcategory = ?", $this->idcategory)
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();
        }
    }

    public function executeFormReportePanel1() {
//        echo "categoria:".$this->getRequestParameter("idcategory")."<br>";
        $this->user = $this->getUser();
        $this->permiso = $this->user->getNivelAcceso("87");
        $this->load_category();
        if ($this->permiso == "3") {
            //    $this->load_category();
//            echo $this->idcategory;
            $this->issues = Doctrine::getTable("KBTooltip")
                    ->createQuery("t")
                    ->select("t.ca_idcategory, t.ca_title, t.ca_info, t.ca_field_id")
                    ->where("t.ca_idcategory = ?", $this->idcategory)
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();
        }
    }

    public function executeFormReportePanelOs() {
        $this->permiso = $this->getUser()->getNivelAcceso("87");
        $this->cache = $this->getRequestParameter("cache");
        if ($this->permiso == "3") {
            $this->load_category();

            $this->issues = Doctrine::getTable("KBTooltip")
                    ->createQuery("t")
                    ->select("t.ca_idcategory, t.ca_title, t.ca_info, t.ca_field_id")
                    ->where("t.ca_idcategory = ?", $this->idcategory)
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();
        }

        $this->dep = $this->getUser()->getIddepartamento();

        $this->pais2 = "todos";
        $this->email = "";
        //echo $this->dep;
        //13 es sistemas
        if ($this->dep == 13 || $this->dep == 14 || $this->dep == 16) {
            $this->modo = constantes::MARITIMO;
            $this->impoexpo = constantes::IMPO;
            $this->pais2 = "Colombia";
            $this->idpais2 = "CO-057";
            $this->email = $this->getUser()->getEmail();
        } else if ($this->dep == 18 || $this->dep == 3) {
            $this->impoexpo = constantes::IMPO;
            $this->pais2 = "Colombia";
            $this->idpais2 = "CO-057";
        } else {
            $this->modo = "";
            $this->impoexpo = "";
        }
    }

    public function executeFormReportePanelAg() {
        $this->permiso = $this->getUser()->getNivelAcceso("87");
        $this->cache = $this->getRequestParameter("cache");
        if (!$this->tipo)
            $this->tipo = "";
        if ($this->permiso == "3") {
            $this->load_category();

            $this->issues = Doctrine::getTable("KBTooltip")
                    ->createQuery("t")
                    ->select("t.ca_idcategory, t.ca_title, t.ca_info, t.ca_field_id")
                    ->where("t.ca_idcategory = ?", $this->idcategory)
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();
        }

        $this->dep = $this->getUser()->getIddepartamento();

        $this->pais2 = "todos";
        $this->email = "";
        //echo $this->dep;
        //13 es sistemas
        if ($this->dep == 13 || $this->dep == 16) {
            $this->modo = constantes::MARITIMO;
            $this->impoexpo = constantes::IMPO;
            $this->pais2 = "Colombia";
            $this->idpais2 = "CO-057";
            //$this->email=$this->getUser()->getEmail();
        } else if ($this->dep == 18 || $this->dep == 3 || $this->dep == 14) {
            if ($this->dep == 14) {
                $this->modo = constantes::MARITIMO;
                $this->email = $this->getUser()->getEmail();
            }
            $this->impoexpo = constantes::IMPO;
            $this->pais2 = "Colombia";
            $this->idpais2 = "CO-057";
        } else {
            $this->modo = "";
            $this->impoexpo = "";
        }

        $this->user = $this->getUser();
    }

    public function executeFormReportePanelOtmmin() {
        $this->permiso = $this->getUser()->getNivelAcceso("87");
        $this->cache = $this->getRequestParameter("cache");
        if ($this->permiso == "3") {
            $this->load_category();

            $this->issues = Doctrine::getTable("KBTooltip")
                    ->createQuery("t")
                    ->select("t.ca_idcategory, t.ca_title, t.ca_info, t.ca_field_id")
                    ->where("t.ca_idcategory = ?", $this->idcategory)
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();
        }

        $this->pais2 = "todos";

        $this->modo = constantes::MARITIMO;
        $this->impoexpo = constantes::OTMDTA;
        $this->user = $this->getUser();
    }

    /*
     * Edita la informacion basica del trayecto
     * @author: Andres Botero
     */

    public function executeFormClientePanel() {
        $this->tiporep = ($this->tiporep) ? $this->tiporep : "0";
    }

    public function executeFormFacturacionPanel() {
        
    }

    public function executeFormMercanciaPanel() {


        if ($this->impoexpo == constantes::EXPO) {
            $this->sia = Doctrine::getTable("Sia")
                    ->createQuery("s")
                    ->select("s.ca_idsia,s.ca_nombre")
                    ->addOrderBy("s.ca_nombre")
                    ->execute();
            $this->nave = "";
            if ($this->modo == constantes::AEREO) {
                $this->nave = "Vuelo";
            } else if ($this->modo == constantes::MARITIMO) {
                $this->nave = "Motonave";
            } else if ($this->modo == constantes::TERRESTRE) {
                $this->nave = "Motonave";
            }
        }
    }

    public function executeFormContinuacionPanel() {
        if (!$this->tipo)
            $this->tipo = "";

        $impoexpo = $this->impoexpo;

        $this->title = ($impoexpo != Constantes::EXPO) ? "Continuación de viaje" : "DTA";
        $usuarios = UsuarioTable::getCoordinadoresOTM();
        //echo count($usuarios);
        $this->usuarios = array();
        foreach ($usuarios as $usuario) {
            if (!isset($this->usuarios[$usuario->getCaIdsucursal()]))
                $this->usuarios[$usuario->getCaIdsucursal()] = "";
            else
                $this->usuarios[$usuario->getCaIdsucursal()].="<br>";
            $this->usuarios[$usuario->getCaIdsucursal()].=$usuario->getCaEmail();
        }
        $this->usuarios["ninguno"] = "No lo maneja Coltrans";
    }

    public function executeFormAduanasPanel() {
        //echo $this->impoexpo;
        $perfil = ($this->impoexpo == Constantes::EXPO) ? "coordinador-aduana-expo" : "coordinador-de-servicio-al-cliente-aduana";
        $this->usuarios = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->innerJoin("u.UsuarioPerfil up")
                ->where("u.ca_activo=? AND up.ca_perfil =? ", array('TRUE', $perfil))
                ->addOrderBy("u.ca_idsucursal")
                ->addOrderBy("u.ca_nombre")
                ->execute();
    }

    public function executeFormSegurosPanel() {
        $usuarios = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->select("u.ca_login")
                ->innerJoin("u.UsuarioPerfil up")
                ->where("u.ca_activo=? AND up.ca_perfil=? ", array('TRUE', 'tramitador-de-polizas'))
                ->addOrderBy("u.ca_nombre")
                //->fetchOne();
                ->execute();

        $conta = count($usuarios);
        for ($i = 0; $i < $conta; $i++) {
            $coma = ($i == ($conta - 1)) ? "" : ",";
            $this->seguro_conf.=$usuarios[$i]->getCaLogin() . $coma;
        }
        $this->user = $this->getUser();
    }

    /*
     * Edita la informacion basica del trayecto
     * @author:
     */

    public function executeFormTrayectoPanel() {
        //echo $this->impoexpo;
        $this->load_category();
        //echo $this->getRequestParameter("impoexpo");
        //echo $this->impoexpo;
        //echo $this->modo;
        $this->origen = "Ciudad Origen";
        $this->destino = "Ciudad Destino";
        if (!$this->tipo)
            $this->tipo = "";
        if ($this->modo == constantes::AEREO) {
            $this->nomLinea = "Aerolinea";
        } else if ($this->modo == constantes::MARITIMO) {
            $this->nomLinea = "Naviera";
            $this->origen = "Puerto Origen";
            $this->destino = "Puerto Destino";
        } else if ($this->modo == constantes::TERRESTRE) {
            $this->nomLinea = "Transportador";
        } else
            $this->nomLinea = "Linea";

        if ($this->impoexpo == constantes::IMPO) {
            $this->pais2 = $this->trafico;
            $this->pais1 = "todos";
        } else if ($this->impoexpo == constantes::EXPO) {
            $this->pais2 = "todos";
            $this->pais1 = $this->trafico;
        } else if ($this->impoexpo == constantes::TRIANGULACION) {
            $this->pais1 = "todos";
            $this->pais2 = "todos";
        } else if ($this->impoexpo == constantes::OTMDTA) {
            $this->pais1 = "todos";
            $this->pais2 = "todos";
        }
        $usuarios = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->select("u.ca_login,u.ca_nombre,u.ca_email,ca_idsucursal")
                ->innerJoin("u.UsuarioPerfil up")
                ->where("u.ca_activo=? AND up.ca_perfil=? ", array('TRUE', 'cordinador-de-otm'))
                ->addOrderBy("u.ca_idsucursal")
                ->addOrderBy("u.ca_nombre")
                ->execute();
        //echo count($usuarios);
        $this->usuarios = array();
        foreach ($usuarios as $usuario) {
            if (!isset($this->usuarios[$usuario->getCaIdsucursal()]))
                $this->usuarios[$usuario->getCaIdsucursal()] = "";
            $this->usuarios[$usuario->getCaIdsucursal()].=$usuario->getCaEmail();
        }
        //print_r($this->usuarios);
    }

    public function executeFormGeneralOsPanel() {
        $this->load_category();
        $this->origen = "Ciudad Origen";
        $this->destino = "Ciudad Destino";
        if ($this->modo == constantes::AEREO) {
            $this->nomLinea = "Aerolinea";
        } else if ($this->modo == constantes::MARITIMO) {
            $this->nomLinea = "Naviera";
            $this->origen = "Puerto Origen";
            $this->destino = "Puerto Destino";
        } else
            $this->nomLinea = "Linea";

        if ($this->impoexpo == constantes::IMPO) {
            $this->pais2 = "CO-057";
            $this->pais1 = "todos";
        } else if ($this->impoexpo == constantes::EXPO) {
            $this->pais2 = "todos";
            $this->pais1 = "CO-057";
        } else if ($this->impoexpo == constantes::TRIANGULACION) {
            $this->pais1 = "todos";
            $this->pais2 = "todos";
        }
        $usuarios = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->select("u.ca_login,u.ca_nombre,u.ca_email,ca_idsucursal")
                ->innerJoin("u.UsuarioPerfil up")
                ->where("u.ca_activo=? AND up.ca_perfil=? ", array('TRUE', 'cordinador-de-otm'))
                ->addOrderBy("u.ca_idsucursal")
                ->addOrderBy("u.ca_nombre")
                ->execute();
        //echo count($usuarios);
        $this->usuarios = array();
        foreach ($usuarios as $usuario) {
            if (!isset($this->usuarios[$usuario->getCaIdsucursal()]))
                $this->usuarios[$usuario->getCaIdsucursal()] = "";
            $this->usuarios[$usuario->getCaIdsucursal()].=$usuario->getCaEmail();
        }
        //print_r($this->usuarios);
    }

    /*
     * Edita la informacion basica del cliente
     * @author: Andres Botero
     */

    public function executeFormPreferenciasPanel() {
        
    }

    /*
     * Edita la informacion aduana
     * @author: Andres Botero
     */

    public function executeFormAduana() {
        $this->repaduana = Doctrine::getTable("RepAduana")->find($this->reporte->getCaIdreporte());
        if (!$this->repaduana) {
            $this->repaduana = new RepAduana();
        }





        //print_r( $this->repaduana );
        //exit();
    }

    /*
     * Instrucciones para el corte de la guia
     * @author: Andres Botero
     */

    public function executeFormCorteGuiasPanel() {
        $this->nomGuiasH = "";
        if ($this->modo == Constantes::AEREO) {
            $this->nomGuiasH = "HAWB";
            $this->nomGuiasM = "MAWB";
        } else if ($this->modo == Constantes::MARITIMO) {
            $this->nomGuiasH = "HBL";
            $this->nomGuiasM = "BL";
        } else if ($this->impoexpo == Constantes::TRIANGULACION) {
            $this->nomGuiasH = "AWB";
            $this->nomGuiasM = "AWB";
        }
    }

    /*
     * Continuacion de viaje (OTM, DTA, CABOTAJE)
     * @author: Andres Botero
     */

    public function executeFormContinuacion() {
        
    }

    public function executeInfoReporte() {
        
    }

    public function executeConsultaTrayecto() {
        
    }

    public function executeConsultaExportaciones() {

        $this->repexpo = Doctrine::getTable("RepExpo")->find($this->reporte->getCaIdreporte());
        if (!$this->repexpo) {
            $this->repexpo = new RepExpo();
        }

        //$this->tiposexpo = ParametroTable::retrieveByCaso( "CU011" );
    }

    /*
     * Consulta la informacion aduana
     * @author: Andres Botero
     */

    public function executeConsultaAduana() {
        $this->repaduana = Doctrine::getTable("RepAduana")->find($this->reporte->getCaIdreporte());
        if (!$this->repaduana) {
            $this->repaduana = new RepAduana();
        }
    }

    /*
     * Consulta la informacion seguro
     * @author: Andres Botero
     */

    public function executeConsultaSeguros() {
        $this->repseguro = Doctrine::getTable("RepSeguro")->find($this->reporte->getCaIdreporte());
        if (!$this->repseguro) {
            $this->repseguro = new RepSeguro();
        }
    }

    /*
     * Instrucciones para el corte de la guia
     * @author: Andres Botero
     */

    public function executeConsultaCorteGuias() {
        $this->load_category();
        $this->nomGuiasH = "";
        if ($this->modo == constantes::AEREO) {
            $this->nomGuiasH = "HAWB";
            $this->nomGuiasM = "MAWB";
        } else if ($this->modo == constantes::MARITIMO) {
            $this->nomGuiasH = "HBL";
            $this->nomGuiasM = "BL";
        } else if ($this->impoexpo == constantes::TRIANGULACION) {
            $this->nomGuiasH = "AWB";
            $this->nomGuiasM = "AWB";
        }
    }

    /*
     *
     */

    public function executeCotizacionWindow() {
        //echo "::".$this->reporte->getCaIdproducto()."::<BR>";
        if ($this->reporte->getCaIdproducto()) {
            $this->producto = Doctrine::getTable("CotProducto")->find($this->reporte->getCaIdproducto());
            $this->cotizacion = $this->producto->getCotizacion();
        } else {
            $this->producto = null;
            //$this->cotizacion = $this->reporte->getCaIdcotizacion();
            $this->cotizacion = null;
        }
    }

    public function executeCotizacionOtmWindow() {
        //echo "::".$this->reporte->getCaIdproducto()."::<BR>";
        if ($this->reporte->getCaIdproductootm()) {
            $this->productootm = Doctrine::getTable("CotProducto")->find($this->reporte->getCaIdproductootm());
            $this->cotizacionotm = $this->productootm->getCotizacion();
        } else {
            $this->productootm = null;
            $this->cotizacionotm = null;
        }
    }

    /*
     *
     */

    public function executeCotizacionRecargosWindow() {
        $this->aplicaciones = ParametroTable::retrieveByCaso("CU082");
        if ($this->reporte->getCaIdproducto()) {
            $this->producto = Doctrine::getTable("CotProducto")->find($this->reporte->getCaIdproducto());
            $this->cotizacion = $this->producto->getCotizacion();
        } else {
            $this->producto = null;
            $this->cotizacion = null;
        }
    }

    public function executeCotizacionRecargosAduanasWindow() {
//      echo "numero de cotizacion:".($this->reporte->getCaIdcotizacion());
//      exit;
        if ($this->reporte->getCaIdcotizacion()) {
            $this->cotizacion = Doctrine::getTable("Cotizacion")
                    ->createQuery("c")
                    ->where("c.ca_consecutivo = ? ", "4682-2010")
                    ->fetchOne();
        } else {
            $this->cotizacion = null;
        }
        $this->aplicaciones = ParametroTable::retrieveByCaso("CU082");
        /*      if( $this->reporte->getCaIdproducto() ){
          $this->producto = Doctrine::getTable("CotProducto")->find( $this->reporte->getCaIdproducto() );
          $this->cotizacion = $this->producto->getCotizacion();
          }else{
          $this->producto = null;
          $this->cotizacion = null;
          }
         */
    }

    public function executeGridPanelInstruccionesWindow() {
        if ($this->modo == Constantes::AEREO)
            $this->instrucciones = ParametroTable::retrieveByCaso("CU039");
        else
            $this->instrucciones = ParametroTable::retrieveByCaso("CU024");
    }

    public function executeListReportesPanel() {
        
    }

    public function executeFiltrosBusqueda() {

        $this->opcion = $this->getRequestParameter("opcion");
        $this->modo = $this->getRequestParameter("modo");
        $this->impoexpo = $this->getRequestParameter("impoexpo");

        $opcion = $this->getRequestParameter("criterio");
        $criterio = trim($this->getRequestParameter("cadena"));
        $this->criterio = ($this->getRequestParameter("criterio") ? $this->getRequestParameter("criterio") : "ca_consecutivo");
        $this->cadena = trim($this->getRequestParameter("cadena"));
        $this->idimpo = $this->getRequestParameter("idimpo");

        $this->fechaInicial = $this->getRequestParameter("fechaInicial");
        $this->fechaFinal = $this->getRequestParameter("fechaFinal");

        $this->seguro = $this->getRequestParameter("seguro");
        $this->colmas = $this->getRequestParameter("colmas");

        $this->transporte = $this->getRequestParameter("transporte");
        $this->modalidad = $this->getRequestParameter("modalidad");
        $this->incoterms = $this->getRequestParameter("incoterms");
        $this->idorigen = $this->getRequestParameter("idorigen");
        $this->iddestino = $this->getRequestParameter("iddestino");
        $this->origen = $this->getRequestParameter("origen");
        $this->destino = $this->getRequestParameter("destino");

        //$this->idsucursal = $this->getRequestParameter("idsucursal");
        //echo $this->getRequestParameter("sucursal");
        //echo $this->getRequestParameter("sucursal");
        $this->sucursal = $this->getRequestParameter("sucursal");
        //echo $this->sucursal;
        $this->continuacion = $this->getRequestParameter("continuacion");
    }

    public function executeFileManager() {
        $year = explode("-", $this->reporte->getCaConsecutivo());
        $this->year = $year[1];

        $folder = "reportes/" . $this->year . "/" . $this->reporte->getCaConsecutivo() . "/instrucciones";
        //echo $folder;
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

        if (!is_dir($directory)) {
            @mkdir($directory, 0777, true);
        }
        chmod($directory, 0777);

        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);
        //echo print_r($archivos);

        $filenames = array();

        $fileTypes = $this->filetypes;

        foreach ($archivos as $archivo) {
            $file = explode("/", $archivo);
            $filenames[]["file"] = $file[count($file) - 1];
        }
        $this->folder = $folder;
        $this->filenames = $filenames;
    }

    public function executeCheckListOtm(sfWebRequest $request) {
        $idreporte = $this->getRequestParameter("id"); //$this->getRequestParameter("id");
        //$this->forward404Unless($idreporte);

        $this->reporte = Doctrine::getTable("Reporte")->find($idreporte);
        if (!$this->reporte) {
            $this->reporte = new Reporte();
        }


        $this->contactos = $this->reporte->getCaConfirmarClie();
        if ($this->reporte->getConsignatario()) {
            $this->contactos .="," . $this->reporte->getConsignatario()->getCaEmail();
        }
    }
}
?>
