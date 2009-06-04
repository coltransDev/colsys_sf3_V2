<script language="javascript">
<?
include_component("traficos", "SessionProvider");
include_component("traficos", "TabCloseMenu");
include_component("traficos", "TrackingViewer");
include_component("traficos", "StatusList");
include_component("traficos", "StatusGrid");
include_component("traficos", "MainPanel");
include_component("traficos", "QueryPanel");
 


?>	
	
</script>
<div style="height:100%"></div>
<div id="header"><div style="float:right;margin:5px;" class="x-small-editor"></div></div>

<!-- Template used for Feed Items -->

<textarea id="preview-tpl" style="display:none;">
    <?=include_partial("previewTpl")?>
</textarea>
