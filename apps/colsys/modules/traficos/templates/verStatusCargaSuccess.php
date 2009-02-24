<script language="javascript">
<?
include_component("traficos", "SessionProvider");
include_component("traficos", "TabCloseMenu");
include_component("traficos", "FeedViewer");
include_component("traficos", "FeedWindow");
include_component("traficos", "FeedGrid");
include_component("traficos", "MainPanel");
include_component("traficos", "FeedPanel");



?>	
	
</script>

<div id="header"><div style="float:right;margin:5px;" class="x-small-editor"></div></div>

<!-- Template used for Feed Items -->
<textarea id="preview-tpl" style="display:none;">
    <div class="post-data">
        <span class="post-date">{pubDate:date("M j, Y, g:i a")}</span>
        <h3 class="post-title">{title}</h3>
        <h4 class="post-author">by {author:defaultValue("Unknown")}</h4>
    </div>
    <div class="post-body">{content:this.getBody}</div>
</textarea>
