<?php

/**
 * gestDocumental components.
 *
 * @package    colsys
 * @subpackage helpdesk
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class helpdeskComponents extends sfComponents {
   

    public function executeFormIndicadoresGestionPanel() {


        $this->grupos = Doctrine::getTable("HdeskGroup")
                ->createQuery("g")
                ->select("g.ca_idgroup, g.ca_name")
                ->distinct()
                ->addOrderBy("g.ca_idgroup")
                ->where("g.ca_iddepartament=13")
                ->execute();
        /*
        if($type_est){
                    $this->fechaInicial = Utils::parseDate($request->getParameter("fechaInicial"));
                    $this->fechaFinal = Utils::parseDate($request->getParameter("fechaFinal"));
                    $this->lcs = $request->getParameter("lcs");
                    $this->lc = $request->getParameter("lc");
                    $this->lci = $request->getParameter("lci");

                    $checkboxGrupo = $request->getParameter( "checkboxGrupo" );
                    $checkboxUsuario = $request->getParameter( "checkboxUsuario" );

                    $this->idgsistemas="";

                    if( $checkboxGrupo ){
                        $this->idgroup = $request->getParameter( "idgroup" );
                        $where=" AND gr.ca_idgroup = '".$this->idgroup."'";
                    }else{
                        $this->idgroup = "";
                        $where = "";
                    }

                    if( $checkboxUsuario ){
                        $this->login = $request->getParameter( "login" );
                        $assigned=" AND tk.ca_assignedto = '".$this->login."'";
                    }else{
                        $this->login = "";
                        $assigned = "";

                    }


                    $con = Doctrine_Manager::getInstance()->connection();
                    $sql="SELECT date_part('month',tk.ca_opened) as mes, tk.ca_idticket, tk.ca_title, tk.ca_assignedto,
                            to_char( nt.ca_fchcreado, 'YYYY-MM-DD') as fechacreado,to_char( nt.ca_fchcreado, 'HH24:MI:SS') as horacreado,
                            to_char( nt.ca_fchterminada, 'YYYY-MM-DD') as fechaterminada, to_char( nt.ca_fchterminada, 'HH24:MI:SS') as horaterminada,
                            gr.ca_name, tk.ca_login, nt.ca_observaciones, nt.ca_fchcreado, nt.ca_fchterminada
                        FROM helpdesk.tb_tickets tk
                            LEFT OUTER JOIN helpdesk.tb_groups gr ON (tk.ca_idgroup = gr.ca_idgroup)
                            LEFT OUTER JOIN notificaciones.tb_tareas nt ON nt.ca_idtarea = tk.ca_idtarea
                        WHERE tk.ca_opened BETWEEN '".$this->fechaInicial."' AND '".$this->fechaFinal."' $where $assigned
                        ORDER BY tk.ca_opened, tk.ca_idticket";

                    $st = $con->execute($sql);
                    $this->idgsistemas = $st->fetchAll();
                }*/
            
    }
}
?>