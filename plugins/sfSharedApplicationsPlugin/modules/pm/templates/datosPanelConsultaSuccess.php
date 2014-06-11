[
<?
$i=0;
foreach( $departamentos as $departamento ){
	if( $i++!=0){
		echo ",";
	}   
?>
	{
		text:'<?=$departamento->getCaNombre()?>',
		leaf:false,
		children:[
            <?
            $grupos = $departamento->getHdeskGroup();
            $j = 0;
            foreach( $grupos as $grupo ){
                if( $j++!=0){
                    echo ",";
                }
            ?>
			{
				text:'<?=$grupo->getCaName()?>',
				leaf:false,
                children:[
                    {
                        text:'Proyectos',
                        leaf:false,
                        children: [
                            <?                            
                            $proyectos = $grupo->getHdeskProject();
                            $k=0;
                            foreach( $proyectos as $proyecto ){
                               if( $k++!=0){
                                    echo ",";
                                }  
                                ?>
                                {
                                    text:'<?=$proyecto->getCaName()?>',
                                    leaf:false,
                                    children: [
                                        {
                                        text:'Usuarios',
                                        leaf:false,
                                        children: [
                                            <?
                                            $usuarios = $grupo->getHdeskUserGroup();
                                            $k=0;
                                            foreach( $usuarios as $usuario ){
                                               if( $k++!=0){
                                                    echo ",";
                                                }
                                            ?>
                                            {
                                                text:'<?=$usuario->getCaLogin()?>',
                                                leaf:false,
                                                children: [
                                                    {
                                                        text: 'Tickets abiertos asignados',
                                                        leaf: true,
                                                        action: 'tickets',
                                                        actionTicket: 'Abierto',
                                                        assignedTo: '<?=$usuario->getCaLogin()?>',
                                                        idproject: '<?=$proyecto->getCaIdproject()?>',
                                                        project: '<?=$proyecto->getCaName()?>',
                                                        department:'<?=$departamento->getCaNombre()?>'
                                                    },
                                                    {
                                                        text: 'Tickets asignados',
                                                        leaf: true,
                                                        action: 'tickets',
                                                        assignedTo: '<?=$usuario->getCaLogin()?>',
                                                        idproject: '<?=$proyecto->getCaIdproject()?>',
                                                        project: '<?=$proyecto->getCaName()?>',
                                                        department:'<?=$departamento->getCaNombre()?>'
                                                    }
                                                ]
                                            }
                                            <?
                                            }
                                            ?>
                                        ]
                                    },
                                    {
                                        text: 'Administrar',
                                        leaf: true,
                                        action: 'adminProject',
                                        idproject: '<?=$proyecto->getCaIdproject()?>',
                                        project: '<?=$proyecto->getCaName()?>',
                                        folder: '<?=base64_encode($proyecto->getDirectorioBase())?>'
                                    },
                                    {
                                        text: 'Tickets Abiertos',
                                        leaf: true,
                                        action: 'tickets',
                                        actionTicket: 'Abierto',
                                        idproject: '<?=$proyecto->getCaIdproject()?>',
                                        project: '<?=$proyecto->getCaName()?>'
                                    },
                                    {
                                        text: 'Tickets',
                                        leaf: true,
                                        action: 'tickets',
                                        idproject: '<?=$proyecto->getCaIdproject()?>',
                                        project: '<?=$proyecto->getCaName()?>'
                                    }
                                ]

                            }
                            <?
                            }
                            ?>
                        ]
                    },
                    {
                        text:'Usuarios',
                        leaf:false,
                        children: [
                            <?
                            $usuarios = $grupo->getHdeskUserGroup();
                            $k=0;
                            foreach( $usuarios as $usuario ){
                               if( $k++!=0){
                                    echo ",";
                                }
                            ?>
                            {
                                text:'<?=$usuario->getCaLogin()?>',
                                leaf:false,
                                children: [
                                    {
                                        text: 'Tickets abiertos asignados',
                                        leaf: true,
                                        action: 'tickets',
                                        actionTicket: 'Abierto',
                                        assignedTo: '<?=$usuario->getCaLogin()?>',
                                        idgroup: '<?=$grupo->getCaIdgroup()?>',
                                        group: '<?=$grupo->getCaName()?>',
                                        department:'<?=$departamento->getCaNombre()?>'
                                    },
                                    {
                                        text: 'Tickets asignados',
                                        leaf: true,
                                        action: 'tickets',
                                        assignedTo: '<?=$usuario->getCaLogin()?>',
                                        idgroup: '<?=$grupo->getCaIdgroup()?>',
                                        group: '<?=$grupo->getCaName()?>',
                                        department:'<?=$departamento->getCaNombre()?>'
                                    },
                                    {
                                        text: 'Calendario',
                                        leaf: true,
                                        action: 'calendar',
                                        user: '<?=$usuario->getCaLogin()?>',
                                        idgroup: '<?=$grupo->getCaIdgroup()?>',
                                        group: '<?=$grupo->getCaName()?>',
                                        department:'<?=$departamento->getCaNombre()?>'
                                    }
                                ]
                            }
                            <?
                            }
                            ?>
                        ]
                    },
                    {
                        text:'Tickets reportados por mi',
                        leaf:true,
                        action: 'tickets',
                        reportedBy: '<?=$user->getUserId()?>',
                        idgroup: '<?=$grupo->getCaIdgroup()?>',
                        group: '<?=$grupo->getCaName()?>',
                        department:'<?=$departamento->getCaNombre()?>'
                    },
                    {
                        text:'Tickets asignados a mi',
                        leaf:true,
                        action: 'tickets',
                        actionTicket: 'Abierto',
                        assignedTo: '<?=$user->getUserId()?>',
                        idgroup: '<?=$grupo->getCaIdgroup()?>',
                        group: '<?=$grupo->getCaName()?>',
                        department:'<?=$departamento->getCaNombre()?>'
                    },
                    {
                        text:'Tickets abiertos del área',
                        leaf:true,
                        action: 'tickets',
                        actionTicket: 'Abierto',
                        idgroup: '<?=$grupo->getCaIdgroup()?>',
                        group: '<?=$grupo->getCaName()?>',
                        department:'<?=$departamento->getCaNombre()?>'
                    },
                    {
                        text:'Todos los tickets del área',
                        leaf:true,
                        action: 'tickets',
                        actionTicket: 'Todos',
                        idgroup: '<?=$grupo->getCaIdgroup()?>',
                        group: '<?=$grupo->getCaName()?>',
                        department:'<?=$departamento->getCaNombre()?>'
                    }
                ]
			}
            <?
            }
            ?>
		]
	}
<?
}
?>

]
<?
//exit;
?>
					