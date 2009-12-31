<?
$issue = $sf_data->getRaw("issue");
?>
<div class="content" align="center">
<div class="yui-skin-sam">
<h1>Administraci&oacute;n de la base de datos de conocimiento</h1>

<br />
    <link rel="stylesheet" type="text/css" href="/js/yui/build/menu/assets/skins/sam/menu.css" />
    <link rel="stylesheet" type="text/css" href="/js/yui/build/button/assets/skins/sam/button.css" />
    <link rel="stylesheet" type="text/css" href="/js/yui/build/fonts/fonts-min.css" />
    <link rel="stylesheet" type="text/css" href="/js/yui/build/container/assets/skins/sam/container.css" />

    <link rel="stylesheet" type="text/css" href="/js/yui/build/editor/assets/skins/sam/editor.css" />
    <script type="text/javascript" src="/js/yui/build/yahoo-dom-event/yahoo-dom-event.js"></script>
    <script type="text/javascript" src="/js/yui/build/animation/animation-min.js"></script>
    <script type="text/javascript" src="/js/yui/build/element/element-min.js"></script>
    <script type="text/javascript" src="/js/yui/build/container/container-min.js"></script>
    <script type="text/javascript" src="/js/yui/build/menu/menu-min.js"></script>
    <script type="text/javascript" src="/js/yui/build/button/button-min.js"></script>
    <script type="text/javascript" src="/js/yui/build/editor/editor-min.js"></script>

        <!--there is no custom header content for this example-->




        <!--BEGIN SOURCE CODE FOR EXAMPLE =============================== -->

        <style type="text/css" media="screen">
            #msgpost_container span.yui-toolbar-insertimage, #msgpost_container span.yui-toolbar-insertimage span.first-child {
                border-color: blue;
            }
        </style>
        <form action="<?=url_for("kbase/formIssue")?>" method="post">
            <input type="hidden" name="id" value="<?=$issue->getCaIdissue()?>"/>
            <table class="tableList" width="80%">
                <tr>
                    <td>
                        <b>Titulo:</b><br />
                        <input type="text" name="title" value="<?=$issue->getCaTitle()?>" size="113" maxlength="255" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Resumen:</b><br />
                        <textarea name="summary" cols="110" rows="2"><?=$issue->getCaSummary()?></textarea>

                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea id="msgpost" name="info"><?=$issue->getCaInfo()?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div align="center"><input type="submit" value="Guardar" class="button"/></div>
                    </td>
                </tr>
            </table>
    </form>
    </div>
</div>
<script type="text/javascript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        win = null;

    var myConfig = {
        height: '500px',
        width: '800px',
        collapse: false ,
    	
        dompath: false, //Turns on the bar at the bottom
        animate: true, //Animates the opening, closing and moving of Editor windows

        toolbar: {
            titlebar: 'Contenido',
                grouplabels: false,
                buttons: [
                   
                { group: 'textstyle', label: 'Font Style',
                    buttons: [
                        { type: 'push', label: 'Bold CTRL + SHIFT + B', value: 'bold' },
                        { type: 'push', label: 'Italic CTRL + SHIFT + I', value: 'italic' },
                        { type: 'push', label: 'Underline CTRL + SHIFT + U', value: 'underline' },                        
                        
                        { type: 'separator' },
                        { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                        { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true },
                        { type: 'separator' },
                        { type: 'push', label: 'Remove Formatting', value: 'removeformat', disabled: true },
                        { type: 'push', label: 'Show/Hide Hidden Elements', value: 'hiddenelements' }
                    ]
                },
                { type: 'separator' },
                { group: 'alignment', label: 'Alignment',
                    buttons: [
                        { type: 'push', label: 'Align Left CTRL + SHIFT + [', value: 'justifyleft' },
                        { type: 'push', label: 'Align Center CTRL + SHIFT + |', value: 'justifycenter' },
                        { type: 'push', label: 'Align Right CTRL + SHIFT + ]', value: 'justifyright' },
                        { type: 'push', label: 'Justify', value: 'justifyfull' }
                    ]
                },
                { type: 'separator' },
                { group: 'parastyle', label: 'Paragraph Style',
                    buttons: [
                    { type: 'select', label: 'Normal', value: 'heading', disabled: true,
                        menu: [
                            { text: 'Normal', value: 'none', checked: true },
                            { text: 'Header 1', value: 'h1' },
                            { text: 'Header 2', value: 'h2' },
                            { text: 'Header 3', value: 'h3' },
                            { text: 'Header 4', value: 'h4' },
                            { text: 'Header 5', value: 'h5' },
                            { text: 'Header 6', value: 'h6' }
                        ]
                    }
                    ]
                },
                { type: 'separator' },
                { group: 'indentlist', label: 'Indenting and Lists',
                    buttons: [
                        { type: 'push', label: 'Indent', value: 'indent', disabled: true },
                        { type: 'push', label: 'Outdent', value: 'outdent', disabled: true },
                        { type: 'push', label: 'Create an Unordered List', value: 'insertunorderedlist' },
                        { type: 'push', label: 'Create an Ordered List', value: 'insertorderedlist' }
                    ]
                },
                { type: 'separator' },
                { group: 'insertitem', label: 'Insert Item',
                    buttons: [
                        { type: 'push', label: 'HTML Link CTRL + SHIFT + L', value: 'createlink', disabled: true },
                        { type: 'push', label: 'Insert Image', value: 'insertimage' }
                    ]
                }

                ]
            }


    };


    var myEditor = new YAHOO.widget.Editor('msgpost', myConfig);
    myEditor.on('toolbarLoaded', function() {
        //When the toolbar is loaded, add a listener to the insertimage button
        this.toolbar.on('insertimageClick', function() {
            //Get the selected element
            var _sel = this._getSelectedElement();
            //If the selected element is an image, do the normal thing so they can manipulate the image
            if (_sel && _sel.tagName && (_sel.tagName.toLowerCase() == 'img')) {
                //Do the normal thing here..
            } else {
                //They don't have a selected image, open the image browser window
                win = window.open('assets/browser.php', 'IMAGE_BROWSER', 'left=20,top=20,width=500,height=500,toolbar=0,resizable=0,status=0');
                if (!win) {
                    //Catch the popup blocker
                    alert('Please disable your popup blocker!!');
                }
                //This is important.. Return false here to not fire the rest of the listeners
                return false;
            }
        }, this, true);
    }, myEditor, true);
    myEditor.on('afterOpenWindow', function() {
        //When the window opens, disable the url of the image so they can't change it
        var url = Dom.get(myEditor.get('id') + '_insertimage_url');
        if (url) {
            url.disabled = true;
        }
    }, myEditor, true);
    myEditor.render();

})();
</script>







