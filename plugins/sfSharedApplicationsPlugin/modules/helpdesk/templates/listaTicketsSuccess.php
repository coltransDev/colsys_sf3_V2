<?
include_component("pm", "editarTicketWindow", array("nivel" => $nivel));
?>

<script type="text/javascript">
    var crearTicket = function () {
        var win = new EditarTicketWindow();
        win.show();
    }
</script>

<div align="center">
    <?
    $numtickets = count($tickets);
    $grupo = null;
    $lastProject = null;
    $project = null;

    if ($numtickets > 0) {
        for ($i = 0; $i < $numtickets; $i++) {
            $ticket = $tickets[$i];

            if ($ticket->getCaIdgroup() != $grupo) {
                $grupo = $ticket->getCaIdgroup();
                $ticketsAbiertos = 0;
                $ticketsSinRespuesta = 0;
                ?>
                <br />
                <br />

                <table width="95%" border="1" class="tableList">
                    <tr>
                        <th colspan="<?= $groupby == "project" ? "10" : "11" ?>"><?= $ticket->getHdeskGroup()->getCaName() ?>
                        </th>
                    </tr>    
                    <tr>
                        <th width="76">Ticket # </th>
                        <th width="223">Titulo</th>
                        <th width="69">Usuario</th>
                        <th width="72">Fecha</th>
                        <th width="58">Tipo</th>
                        <?
                        if ($groupby != "project") {
                            ?>
                            <th width="110">Proyecto</th>
                            <?
                        }
                        ?>
                        <th width="110">Prioridad</th>
                        <th width="110">Asignado a</th>
                        <th width="95">Fecha Respuesta </th>
                        <th width="95">Fecha ult.seguimiento </th>

                        <th width="88">Estado</th>
                    </tr>    
                    <?
                }

                $class = "";

                if ($ticket->getCaAction() == "Abierto") {
                    $ticketsAbiertos++;
                }

                if ($ticket->getCaAction() != "Abierto") {
                    $class = "blue";
                } else {
                    if ($ticket->getCaPriority() == "Media") {
                        $class = "yellow";
                    }

                    if ($ticket->getCaPriority() == "Alta") {
                        $class = "pink";
                    }
                }


                if ($ticket->getHdeskProject()->getCaName()) {
                    $project = $ticket->getHdeskProject()->getCaName();
                } else {
                    $project = "";
                }

                if ($groupby == "project" && ($lastProject != $project || $lastProject === null)) {
                    $lastProject = $project;
                    ?>   
                    <tr class="row0">
                        <td colspan="10"><div align="left"><b>
                        <?
                        if ($project) {

                            if ($nivel > 0) {
                                echo link_to($project, "helpdesk/listaTickets?opcion=personalizada&project=" . $ticket->getHdeskProject()->getCaIdproject());
                            } else {
                                echo $project;
                            }
                        } else {
                            echo "Sin proyecto asignado";
                        }
                        ?>
                        </b>
                        </div></td>
                    </tr>
                    <?
                }
                ?>
                <tr class="<?= $class ?>">
                    <td><?= link_to($ticket->getCaIdticket(), "helpdesk/verTicket?id=" . $ticket->getCaIdticket()) ?></td>
                    <td><?= link_to($ticket->getCaTitle(), "helpdesk/verTicket?id=" . $ticket->getCaIdticket(), array("class" => "qtip", "title" => str_replace("\"", "'", $ticket->getCaText()))) ?></td>
                    <td><?= $ticket->getCaLogin() ?></td>
                    <td><?= Utils::fechaMes($ticket->getCaOpened("Y-m-d")) ?></td>
                    <td><?= $ticket->getCaType() ?></td>
                    <?
                        if ($groupby != "project") {
                            ?>
                            <td>
                                <?
                                if ($project) {
                                    if ($nivel > 0) {
                                        echo link_to($project, "helpdesk/listaTickets?opcion=personalizada&project=" . $ticket->getHdeskProject()->getCaIdproject());
                                    } else {
                                        echo $project;
                                    }
                                } else {
                                    echo "&nbsp;";
                                }
                                ?>
                            </td>
                            <?
                        }
                        ?>
                    <td><?= $ticket->getCaPriority() ?></td>
                    <td><? echo $ticket->getCaAssignedto();?></td>
                    <td>
                        <?
                        //$tarea = $ticket->getNotTarea();
                        if ($ticket->getNotTarea()->getCaFchterminada()) {
                            echo Utils::fechaMes(Utils::parseDate($ticket->getNotTarea()->getCaFchterminada(), "Y-m-d")) . " " . Utils::parseDate($ticket->getNotTarea()->getCaFchterminada(), "H:i");
                        } else {
                            echo "&nbsp;";
                            $ticketsSinRespuesta++;
                        }
                        ?>
                    </td>
                    <td>
                        <?
                        $response = $ticket->getLastResponse();
                        if ($response) {
                            echo Utils::fechaMes(Utils::parseDate($response->getCaCreatedat(), "Y-m-d")) . " " . Utils::parseDate($response->getCaCreatedat(), "H:i");
                        } else {
                            echo "&nbsp;";
                        }
                        ?>
                    </td>	
                    <td><?= $ticket->getCaAction() ?> </td>
                </tr> 
                <?
                if (!isset($tickets[$i + 1]) || $tickets[$i + 1]->getCaIdgroup() != $grupo) {
                    ?>
                </table>
                <br />
                <b>Ticket Abiertos:</b> <?= $ticketsAbiertos ?> <b>Tickets Sin Respuesta:</b> <?= $ticketsSinRespuesta ?>		
                <br /><br />
            <?
        }
        ?>
        <?
        }
    } else {
    ?>
        <div>No hay tickets con ese criterio o usted no posee permisos para verlo. Consulte el administrador.<br/>
            <a href="<?= url_for('helpdesk/index') ?>">Volver</a>
        </div>
        <?
    }
?>
<br />
<br />
</div>