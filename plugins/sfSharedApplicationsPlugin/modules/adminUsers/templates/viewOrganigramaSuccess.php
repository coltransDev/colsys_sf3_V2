<?php

    sfContext::getInstance()->getResponse()->removeStylesheet("/js/ext4/resources/css/ext-all-neptune.css");
    sfContext::getInstance()->getResponse()->removeJavascript("ext4/ext-all.js");
    sfContext::getInstance()->getResponse()->removeJavascript("ext4/ux/multiupload/swfobject.js");
    sfContext::getInstance()->getResponse()->removeJavascript("comunes.js");
    sfContext::getInstance()->getResponse()->removeJavascript("jquery/jquery.js");
    sfContext::getInstance()->getResponse()->removeJavascript("jquery/jquery-ui.min.js");
    sfContext::getInstance()->getResponse()->removeJavascript("jquery/jquery.dimensions.js");

    $usuariosNal = $sf_data->getRaw("usuariosNal");
    $presidencia = $sf_data->getRaw("presidencia");

?>
<head>
    <link rel="stylesheet" href="../../../js/jquery/ui-lightness/jquery-ui-1.10.2.custom.css" />
    <script type="text/javascript" src="../../../js/jquery/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="../../../js/jquery/jquery-ui-1.10.2.custom.min.js"></script>

    <script type="text/javascript" src="../../../js/primitives.min.js"></script>
    <link href="../../../css/primitives.latest.css" media="screen" rel="stylesheet" type="text/css" />

    <script type='text/javascript'>//<![CDATA[ 
        var m_timer = null;
        $(window).load(function () {
            var panel = jQuery("#panel");
            var orgchartform = panel.find("[name=orgchartform]");
            var orgchart = panel.find("[name=orgchart]");
            var treeItems = {};
            
            var items = [
                new primitives.orgdiagram.ItemConfig({
                    id: "<?=$presidencia->getCaLogin()?>",
                    parent: null,
                    title: "<?=$presidencia->getCaNombre()?>",
                    description: "<?=$presidencia->getCaCargo()?>",
                    image: "<?=$presidencia->getImagenUrl()?>",
                    email: "<?=$presidencia->getSucursal()->getCaNombre()?>",
                    //groupTitle: "<?=$presidencia->getCaDepartamento()?>",
                    //groupTitleColor: primitives.common.Colors.Gray,
                    templateName: "contactTemplate"                    
                })
            ];

            <?
            foreach($usuariosNal as $usuario){
                ?>
                items.push(new primitives.orgdiagram.ItemConfig({
                    id: "<?=$usuario->getCaLogin()?>",
                    parent: "<?=$usuario->getCaManager()?>",
                    title: "<?=$usuario->getCaNombre()?>",
                    description: "<?=$usuario->getCaCargo()?>",
                    image: "<?=$usuario->getImagenUrl()?>",
                    email: "<?=$usuario->getSucursal()->getCaNombre()?>",
                    itemTitleColor: "#F7AF39"
                    <?
                    if(count($usuario->getSubordinado())>0){
                        ?>,
                        //email: "<?=$usuario->getCaEmail()?>",                        
                        //groupTitle: "<?=$usuario->getCaDepartamento()?>",
                        //groupTitleColor: primitives.common.Colors.Gray,
                        //itemTitleColor: primitives.common.Colors.RoyalBlue,
                        templateName: "contactTemplate"
                        <?
                    }
                    ?>
                }));            
                <?
            }
            ?>

            /* store ItemConfig-s in hash by id*/
            for (var index = 0, len = items.length; index < len; index += 1) {
                treeItems[items[index].id] = items[index];
            }
            
            function GetOrgDiagramConfig() {
                /*var pageFitMode = 3;
                var verticalAlignment = 0;
                var horizontalAlignment = 1;
                var connectorType = 0;
                var minimalVisibility = 1;
                var selectionPathMode = 0;
                var leavesPlacementType = 2;
                var childrenPlacementType = 1;
                var hasSelectorCheckbox = 2;
                var hasButtons = 2;*/
        
                //var items = items;
                //var cursorItem = 0;
                /*var buttonsPanelSize = 48;*/
                var pageFitMode = 1;
                /*var minimalVisibility = 2;
                var graphicsType = primitives.common.GraphicsType.Auto;
                var hasSelectorCheckbox = primitives.common.Enabled.True;
                var hasButtons = primitives.common.Enabled.True;
                var leavesPlacementType = 2;
                var childrenPlacementType = 1;
                var verticalAlignment=1;
                var horizontalAlignment = 1;*/

                //var photoTemplateCheckbox = jQuery("#photoTemplate").prop("checked");
                //var contactTemplateCheckbox = jQuery("#contactTemplate").prop("checked");

                var buttons = [];
                //buttons.push(new primitives.orgdiagram.ButtonConfig("properties", "ui-icon-gear", "Info"));
                /*buttons.push(new primitives.orgdiagram.ButtonConfig("properties", "ui-icon-gear", "Info"));
                buttons.push(new primitives.orgdiagram.ButtonConfig("add", "ui-icon-person", "Add"));*/

                /*var templates = [];
                templates.push(getManagerTemplate());*/

                var templates = [
                    getContactTemplate(),
                    getRegularTemplate()/*,
                    getLoaderTemplate() /* dummy item indicating children loading process */
                ];

                return {
                     //graphicsType: graphicsType,
                    /*items :items,
                    cursorItem: 0,
                    pageFitMode: pageFitMode,*/
                    hasButtons: primitives.common.Enabled.True,
                    /*hasSelectorCheckbox: primitives.common.Enabled.True,*/
                    buttons: buttons,
                    templates: templates,
                    onButtonClick: onButtonClick,
                    /*onCursorChanging: onCursorChanging,
                    onCursorChanged: onCursorChanged,
                    onHighlightChanging: onHighlightChanging,
                    onHighlightChanged: onHighlightChanged,
                    onSelectionChanged: onSelectionChanged,*/
                    onItemRender: onTemplateRender,
                    /*onHighlightRender: onHighlightRender,*/
                    itemTitleFirstFontColor: primitives.common.Colors.White,
                    itemTitleSecondFontColor: primitives.common.Colors.White,
                    labelOffset: 2,
                    defaultTemplateName: "regularTemplate",
                    /*normalLevelShift: 20,
                    dotLevelShift: 20,
                    normalItemsInterval: 10,
                    dotItemsInterval: 2*/
                };
            }
            
            function onTemplateRender(event, data) {
                switch (data.renderingMode) {
                    case primitives.common.RenderingMode.Create:
                        data.element.find("[name=email]").click(function (e) {
                            /* Block mouse click propogation in order to avoid layout updates before server postback*/
                            primitives.common.stopPropagation(e);
                        });
                        /* Initialize widgets here */
                        break;
                    case primitives.common.RenderingMode.Update:
                        /* Update widgets here */
                        break;
                }

                var itemConfig = data.context,
                    itemTitleColor = itemConfig.itemTitleColor != null ? itemConfig.itemTitleColor : primitives.common.Colors.RoyalBlue;

                data.element.find("[name=photo]").attr({ "src": itemConfig.image });
                data.element.find("[name=titleBackground]").css({ "background": itemTitleColor });
                data.element.find("[name=email]").attr({ "href": ("mailto:" + itemConfig.email + "?Subject=Hello%20world") });

                var fields = ["title", "description", "phone", "email"];
                for (var index = 0; index < fields.length; index += 1) {
                    var field = fields[index];

                    var element = data.element.find("[name=" + field + "]");
                    if (element.text() != itemConfig[field]) {
                        element.text(itemConfig[field]);
                    }
                }

                if (data.templateName == "loaderTemplate") {
                    var itemConfig = data.context;

                    var badge = data.element.find("[name=badge]");
                    badge.text(itemConfig['childrencount']);
                    badge.css({ "background-color": itemConfig.itemTitleColor });
                }
            }
            
            function onButtonClick(e, data) {
                var message = "User clicked <b>'" + data.name + "'</b> button for item <b>'" + data.context.title + "'</b>.";
                message += (data.parentItem != null ? " Parent item <b>'" + data.parentItem.title + "'" : "");                
                jQuery("#southpanel").empty().append(message);
                jQuery(orgchartform).dialog("close");
                location.href="<?=url_for('adminUsers/viewUser')?>"+"/login/"+data.context.id;
            }
            
            function getContactTemplate() {
                var result = new primitives.orgdiagram.TemplateConfig();
                result.name = "contactTemplate";

                result.itemSize = new primitives.common.Size(90, 120);
                result.minimizedItemSize = new primitives.common.Size(4, 4);
                result.minimizedItemCornerRadius = 2;
                result.highlightPadding = new primitives.common.Thickness(2, 2, 2, 2);


                var itemTemplate = jQuery(
                              '<div class="bp-item bp-corner-all bt-item-frame">'/*
                                    + '<div name="titleBackground" class="bp-item bp-corner-all bp-title-frame" style="top: 2px; left: 2px; width: 216px; height: 20px;">'
                                            + '<div name="title" class="bp-item bp-title" style="top: 3px; left: 6px; width: 208px; height: 18px;">'
                                            + '</div>'
                                    + '</div>'*/
                                    + '<div class="bp-item bp-photo-frame" style="top: 3px; left: 22px; width: 50px; height: 60px;">'
                                            + '<img name="photo" style="height: 60px; width:50px;" />'
                                    + '</div>'/*
                                    + '<div name="phone" class="bp-item" style="top: 26px; left: 56px; width: 162px; height: 18px; font-size: 12px;"></div>'
                    + '<div class="bp-item" style="top: 44px; left: 56px; width: 162px; height: 18px; font-size: 12px;"><a name="email" href="" target="_top"></a></div>'*/
                                    + '<div name="description" class="bp-item" style="top: 73px; left: 3px; width: 90px; height: 39px; font-size: 10px;"></div>'
                            + '</div>'
                            ).css({
                                width: result.itemSize.width + "px",
                                height: result.itemSize.height + "px"
                            }).addClass("bp-item bp-corner-all bt-item-frame");
                result.itemTemplate = itemTemplate.wrap('<div>').parent().html();

                return result;
            }

        function getRegularTemplate() {
            var result = new primitives.orgdiagram.TemplateConfig();
            result.name = "regularTemplate";

            result.itemSize = new primitives.common.Size(90, 120);
            result.minimizedItemSize = new primitives.common.Size(4, 4);
            result.highlightPadding = new primitives.common.Thickness(2, 2, 2, 2);


            var itemTemplate = jQuery(
              '<div class="bp-item bp-corner-all bt-item-frame">'/*
                + '<div name="titleBackground" class="bp-item bp-corner-all bp-title-frame" style="top: 2px; left: 2px; width: 176px; height: 18px; overflow: hidden; text-align:center;">'
                    + '<div name="title" class="bp-item bp-title" style="top: 2px; left: 2px; width: 172px; height: 14px; font-size: 12px; overflow: hidden;">'
                    + '</div>'
                + '</div>'*/
                + '<div class="bp-item bp-photo-frame" style="top: 3px; left: 22px; width: 50px; height: 60px; overflow: hidden;">'
                    + '<img name="photo" style="height:60px; width:50px;" />'
                + '</div>'/*
                + '<div class="bp-item" style="top: 22px; left: 56px; width: 118px; height: 20px; font-size: 11px;"><a name="email" href="" target="_top"></a></div>'*/
                + '<div name="description" class="bp-item" style="top: 73px; left: 3px; width: 90px; height: 39px; font-size: 9px; overflow: hidden;"></div>'
            + '</div>'
            ).css({
                width: result.itemSize.width + "px",
                height: result.itemSize.height + "px"
            }).addClass("bp-item bp-corner-all bt-item-frame");
            result.itemTemplate = itemTemplate.wrap('<div>').parent().html();

            var highlightTemplate = jQuery("<div></div>")
                .css({
                    position: "absolute",
                    overflow: "visible",
                    width: (result.itemSize.width + result.highlightPadding.left + result.highlightPadding.right) + "px",
                    height: (result.itemSize.height + result.highlightPadding.top + result.highlightPadding.bottom) + "px",
                    "border-style": "solid",
                    "border-width": "1px"
                }).addClass("bp-item2 bp-corner-all bp-cursor-frame");

            highlightTemplate.append("<div name='badge' class='bp-badge2 bp-item' style='top:45px; left:114px; z-index: 1000; background-color:green; color: white;'></div>");

            result.highlightTemplate = highlightTemplate.wrap('<div>').parent().html();

            return result;
        }


            
            /* Select single item */
            panel.find("[name=buttonsingle]").click(function (e) {
                var itemConfig = null;
                orgchartform.dialog({
                    autoOpen: false,
                    minWidth: 1200,
                    minHeight: 600,
                    modal: true,
                    title: "GRUPO EMPRESARIAL COLTRANS S.A.S.",
                    buttons: {
                       /* "Select": function () {                            
                            
                            var cursorItem = orgchart.orgDiagram("option", "cursorItem");
                            var itemConfig = treeItems[cursorItem];
                            panel.find("[name=message]").empty().append("Selected item title=" + itemConfig.title)
                            
                            jQuery(this).dialog("close");
                            location.href="<?=url_for('adminUser/formUsuario')?>"+"/id/"+itemConfig.id;
                        },*/
                        Cancel: function () {
                            jQuery(this).dialog("close");
                        }
                    },
                    resizeStop: function (event, ui) {
                        var panelSize = new primitives.common.Rect(0, 0, orgchartform.outerWidth(), orgchartform.outerHeight());
                        orgchart.css(panelSize.getCSS());
                        orgchart.orgDiagram("update", primitives.orgdiagram.UpdateMode.Recreate);
                    },
                    open: function (event, ui) {
                        var panelSize = new primitives.common.Rect(0, 0, orgchartform.outerWidth(), orgchartform.outerHeight());
                        orgchart.css(panelSize.getCSS());
                        /* Chart is already created, so in regular situation we have to use Refresh update mode,
                            but here jQuery removes dialog contents and adds them back, so that procedure invalidates
                            invalidates VML in IE6 mode, so when we open dialog we use full Redraw update mode. */
                        
                        var options = new primitives.orgdiagram.Config();
           
                        options.items = items;
                        options.cursorItem = 0;
                        options.buttonsPanelSize = 48;
                        options.pageFitMode = 1;
                        options.minimalVisibility = 1;
                        options.graphicsType = primitives.common.GraphicsType.Auto;
                        options.hasSelectorCheckbox = primitives.common.Enabled.False;
                        options.hasButtons = primitives.common.Enabled.True;
                        options.leavesPlacementType = 2;
                        options.childrenPlacementType = 1;
                        options.verticalAlignment=1;
                        options.horizontalAlignment = 1;

                        orgchart.orgDiagram(options);
                        //var selector = jQuery("#panel");
                        orgchart.orgDiagram(GetOrgDiagramConfig())
                        orgchart.orgDiagram("option", GetOrgDiagramConfig());
                        orgchart.orgDiagram("update", primitives.orgdiagram.UpdateMode.Recreate);
                    }
                }).dialog("open");
                
                $(window).resize(function () {
                    onWindowResize();
                });
            })

            /* Check multiple items */
            panel.find("[name=buttonmultiple]").click(function (e) {
                var itemConfig = null;
                orgchartform.dialog({
                    autoOpen: false,
                    minWidth: 1200,
                    minHeight: 600,
                    modal: true,
                    title: "GRUPO EMPRESARIAL COLTRANS",
                    buttons: {
                        /*"Select": function () {
                            var selectedItems = orgchart.orgDiagram("option", "selectedItems");
                            var message = "";
                            for (var index = 0; index < selectedItems.length; index++) {
                                var itemConfig = treeItems[selectedItems[index]];
                                if (message != "") {
                                    message += ", ";
                                }
                                message += "<b>'" + itemConfig.id + "'</b>";
                            }
                            //panel.find("[name=message]").empty().append("User selected next items: " + message);
                            jQuery(this).dialog("close");
                        },*/
                        Cancel: function () {
                            jQuery(this).dialog("close");
                        }
                    },
                    resizeStop: function (event, ui) {
                        var panelSize = new primitives.common.Rect(0, 0, orgchartform.outerWidth(), orgchartform.outerHeight());
                        orgchart.css(panelSize.getCSS());
                        orgchart.orgDiagram("update", primitives.orgdiagram.UpdateMode.Refresh);
                    },
                    open: function (event, ui) {
                        var panelSize = new primitives.common.Rect(0, 0, orgchartform.outerWidth(), orgchartform.outerHeight());
                        orgchart.css(panelSize.getCSS());
                        /* Chart is already created, so in regular situation we have to use Refresh update mode,
                            but here jQuery removes dialog contents and adds them back, so that procedure invalidates
                            invalidates VML in IE6 mode, so when we open dialog we use full Redraw update mode. */
        
                        var options = new primitives.orgdiagram.Config();
           
                        options.items = items;
                        options.cursorItem = 0;
                        options.buttonsPanelSize = 48;
                        options.pageFitMode = 1;
                        options.minimalVisibility = 2;
                        options.graphicsType = primitives.common.GraphicsType.Auto;
                        options.hasSelectorCheckbox = primitives.common.Enabled.True;
                        options.hasButtons = primitives.common.Enabled.True;
                        options.leavesPlacementType = 2;
                        options.childrenPlacementType = 2;
                        options.verticalAlignment=1;
                        options.horizontalAlignment = 0;

                        orgchart.orgDiagram(options);
                        orgchart.orgDiagram(GetOrgDiagramConfig())
                        orgchart.orgDiagram("option", GetOrgDiagramConfig());
                        
                        orgchart.orgDiagram("update", primitives.orgdiagram.UpdateMode.Recreate);
                    }
                }).dialog("open").resizable();
            })
        });//]]> 
        
        

        function ResizePlaceholder() {
            var bodyWidth = $(window).width() - 40
            var bodyHeight = $(window).height() - 20
            jQuery("#orgdiagram").css(
            {
                "width": bodyWidth + "px",
                "height": bodyHeight + "px"
            });
        }

    </script>
</head>
<b>Organigrama</b><br/>
<h3><?=($manager->getCaDepartamento()) ?></h3><br/>
<br/>
<div class="box1">
    <table bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0" align="center">
       <tbody>
        <tr>
            <td width="150" align="center">
                <font size="2">
                    <b><a href="<?=url_for('adminUsers/viewUser?login='.$manager->getCaLogin()) ?>"><?=($manager->getCaNombre())?></a></b>
                </font>
            </td>
        </tr>
        <tr>
            <td width="150" align="center"><font size="1"><?=$manager->getCaCargo()?></font></td>
        </tr>
        <?
        if( $manager->getCaManager() ){
        ?>
        <tr>
            <td width="150" align="center">
                <?=link_to(image_tag("left.gif"),"adminUsers/viewOrganigrama?login=".$manager->getCaManager())?></td>
        </tr>
        <?
        }
        ?>
    </table>
</div>

<table bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0" align="center">
<?
    $numUsuarios = count($usuarios);
    for ($i=0; $i<$numUsuarios; $i++){
        $usuario = $usuarios[$i];
        if( !$usuario->getcaActivo() ){
            continue;
        }
        ?>
        <tr>
            <td align="right">
                <?
                if($i==$numUsuarios-1){
                    echo image_tag("l.jpg");
                }else{
                    echo image_tag("t.jpg");
                }
                ?>
            </td>
            <td>
                <div class="box1">
                    <table bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="150" align="center">
                                    <font size="2">
                                        <b><a href="<?=url_for('adminUsers/viewUser?login='.$usuario->getCaLogin()) ?>"><?=($usuario->getCaNombre())?></a></b>
                                    </font>
                                </td>
                            </tr>
                            <tr>
                                <td width="150" align="center"><font size="1"><?=($usuario->getCaCargo())?></font></td>
                            </tr>
                            <?
                            $subs = $usuario->getSubordinado();
                            if(count($subs)>0){
                                ?>
                                <tr>
                                    <td width="150" align="center">
                                        <?=link_to(image_tag("right.gif"),"adminUsers/viewOrganigrama?login=".$usuario->getCaLogin())?></td>
                                </tr>
                                <?
                            }
                            ?>
                    </table>
                </div>
            </td>
	</tr>
        <?
    }
    ?>
</table>

<div id="panel">
    <br>
    <div><input name="buttonsingle" class="bigbuttonmin" style="width:250px;" type="button" value="Ver Organigrama Completo(Vertical)" />

    <input name="buttonmultiple" class="bigbuttonmin" style="width:250px;" type="button" value="Ver Organigrama Completo(Horizontal)" /></div>
    <div>
        <div name="orgchartform" class="dialog-form" style="overflow: hidden;">
            <div name="orgchart" class="bp-item" style="overflow: hidden; padding: 0px; margin: 0px; border: 0px;"></div>
        </div>
    </div>
    <p name="message"></p>
</div>
