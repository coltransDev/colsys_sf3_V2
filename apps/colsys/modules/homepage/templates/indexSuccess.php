<?

include_component("pm", "editarTicketWindow", array("nivel"=>$nivelTickets));
?>

<script type="text/javascript">
var crearTicket = function(){
    var win = new EditarTicketWindow();
    win.show();
}
</script>


<div id="viewport">
    <div class="content">
        <div id="bd">
            <div id="products" class="extjs">
                <h1 class="pagetitle">COLSYS <span>Sistema de Informaci&oacute;n</span> </h1>
                <div id="samples">
                    <div id="samples-cb">
                        <img src="/images/s.gif" class="normal-view" title="Full view with descriptions"/>
                        <img src="/images/s.gif" class="condensed-view" title="Condensed view" />
                        <img src="/images/s.gif" class="mini-view" title="Mini view" />
                    </div>
                    <div id="sample-menu"><div id="sample-menu-inner"></div></div>
                    <div id="sample-box">
                        <div id="sample-box-inner"></div>
                    </div>
                </div>
            </div>


            <div style="padding:10px 0 0;">
                <div class="left-column">
                    <?

                    include_component("notificaciones","tareasPendientes");
                    
                    include_component("homepage", "novedades", array( "nivelNoticias"=>$nivelNoticias )) ;

                    include_component("survey","listaEvaluaciones");

                    ?>
                </div>

                <div class="right-column" style="padding-top:15px;">
                    <div class="side-box"><div class="side-box-inner">
                            <h5>Links</h5>
                            <ul class="features">
                                <li><a href="#" onClick="crearTicket()">Nuevo ticket</a></li>
                                <li><a href="http://www.coltrans.com.co/intranet" target="blank">Intranet</a></li>
                                <li><a href="https://www.coltrans.com.co/tracking/login/novell" target="blank">Tracking</a></li>
                                <li><a href="http://correoapp.coltrans.com.co" target="blank">Google Apps</a></li>
                            </ul>

                        </div>
                    </div>
                    <br />

                    <div class="side-box"><div class="side-box-inner">
                            <h5>Plantillas</h5>
                            <h4>Coltrans S.A.S.</h4>
                            <ul class="features">
                                <li><a href="./plantillas/coltrans/plantillaColtransBarranquilla2014.doc" target="blank">Barranquilla</a></li>
                                <li><a href="./plantillas/coltrans/plantillaColtransBogota2014.doc" target="blank">Bogot&aacute; D.C.</a></li>
                                <li><a href="./plantillas/coltrans/plantillaColtransBucaramaga2011.doc" target="blank">Bucaramaga</a></li>
                                <li><a href="./plantillas/coltrans/plantillaColtransBuenaventura2011.doc" target="blank">Buenaventura</a></li>
                                <li><a href="./plantillas/coltrans/plantillaColtransCali2014.doc" target="blank">Cali</a></li>
                                <li><a href="./plantillas/coltrans/plantillaColtransCartagena2011.doc" target="blank">Cartagena</a></li>
                                <li><a href="./plantillas/coltrans/plantillaColtransMedellin2014.doc" target="blank">Medell&iacute;n</a></li>
                                <li><a href="./plantillas/coltrans/plantillaColtransPereira2011.doc" target="blank">Pereira</a></li>
                            </ul>

                            <h4>Colmas Ltda.</h4>
                            <ul class="features">
                                <li><a href="./plantillas/colmas/plantillaColmasBarranquilla2011.doc" target="blank">Barranquilla</a></li>
                                <li><a href="./plantillas/colmas/plantillaColmasBogota2011.doc" target="blank">Bogota</a></li>
                                <li><a href="./plantillas/colmas/plantillaColmasBuenaventura2011.doc" target="blank">Buenaventura</a></li>
                                <li><a href="./plantillas/colmas/plantillaColmasCali2011.doc" target="blank">Cali</a></li>
                                <li><a href="./plantillas/colmas/plantillaColmasCartagena2011.doc" target="blank">Cartagena</a></li>
                                <li><a href="./plantillas/colmas/plantillaColmasMedellin2011.doc" target="blank">Medell&iacute;n</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <div style="clear:both"></div>

        </div>
    </div>
</div><!-- end viewport -->



<script type="text/javascript">
    Ext.onReady(function(){

        var catalog = [

<?
$i = 0;
foreach ($grupos as $key => $grupo) {

    if ($i > 0) {
        echo ",";
    }
?>
                {
                    title: '<?= $key ?>',
                    iconCls:'icon-apps',
<?= ($i++ == 0) ? "cls:'active'," : "" ?>
                    samples: [
<?
    $j = 0;
    foreach ($grupo as $rutina) {
        if ($j++ > 0) {
            echo ",";
        }
?>
                            {
                                text: '<?= $rutina["ca_opcion"] ?>',
                                url: '<?= $rutina["ca_programa"] ?>',
                                icon: '<?= isset($rutina["ca_icon"]) ? $rutina["ca_icon"] : "" ?>',
                                desc: '<?= $rutina["ca_descripcion"] ?>',
                                status: 'new'
                            }
<?
    }
?>
                    ]
                }
<?
}
?>

        ];


        for(var i = 0, c; c = catalog[i]; i++){
            c.id = 'sample-' + i;
        }

        var menu = Ext.get('sample-menu-inner'),
        ct = Ext.get('sample-box-inner');

        var tpl = new Ext.XTemplate(
        '<div id="sample-ct">',
        '<tpl for=".">',        
        '<div><a name="{id}" id="{id}"></a><h2><div unselectable="on">{title}</div></h2>',
        '<dl>',
        '<tpl for="samples">',
        '<dd ext:url="{url}"><img title="{text}" src="{icon}"/>',
        '<div><h4>{text}</h4><p>{desc}</p></div>',
        '</dd>',        
        '</tpl>',
        '<div style="clear:left"></div></dl></div>',
        '</tpl>',
        '</div>'
    );

        tpl.overwrite(ct, catalog);


        var tpl2 = new Ext.XTemplate(
        '<tpl for="."><a href="#{id}" hidefocus="on" class="{cls}" id="a4{id}"><img src="/images/s.gif" class="{iconCls}">{title}</a></tpl>'
    );
        tpl2.overwrite(menu, catalog);


        function calcScrollPosition(){
            var found = false, last;
            ct.select('a[name]', true).each(function(el){
                last = el;
                if(el.getOffsetsTo(ct)[1] > -5){
                    activate(el.id)
                    found = true;
                    return false;
                }
            });
            if(!found){
                activate(last.id);
            }
        }

        var bound;
        function bindScroll(){
            ct.on('scroll', calcScrollPosition, ct, {buffer:250});
            bound = true;
        }
        function unbindScroll(){
            ct.un('scroll', calcScrollPosition, ct);
            bound = false;
        }
        function activate(id){
            Ext.get('a4' + id).radioClass('active');
        }

        ct.on('mouseover', function(e, t){
            if(t = e.getTarget('dd')){
                Ext.fly(t).addClass('over');
            }
        });
        ct.on('mouseout', function(e, t){
            if((t = e.getTarget('dd')) && !e.within(t, true)){
                Ext.fly(t).removeClass('over');
            }
        });
        ct.on('click', function(e, t){
            if((t = e.getTarget('dd', 5)) && !e.getTarget('a', 3)){
                var url = Ext.fly(t).getAttributeNS('ext', 'url');
                if(url){
                    document.location =  url;
                }
            }else if(t = e.getTarget('h2', 3, true)){
                t.up('div').toggleClass('collapsed');
            }
        });

        menu.on('click', function(e, t){
            e.stopEvent();
            if((t = e.getTarget('a', 2)) && bound){
                var id = t.href.split('#')[1];
                var top = Ext.getDom(id).offsetTop;
                Ext.get(t).radioClass('active');
                unbindScroll();
                ct.scrollTo('top', top, {callback:bindScroll});
            }
        });

        Ext.get('samples-cb').on('click', function(e){
            var img = e.getTarget('img', 2);
            if(img){
                Ext.getDom('samples').className = img.className;
                calcScrollPosition.defer(10);
            }
        });

        bindScroll();
    });

</script>