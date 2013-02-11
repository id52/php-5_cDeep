{loader src='highslide.js' base='/js/highslide/' type='js' comment='Highslide'}
{loader src='highslide.css' base='/js/highslide/' type='css'}
{literal}
<script type="text/javascript">
	hs.graphicsDir = '/js/highslide/graphics/';
	hs.wrapperClassName = 'wide-border';
</script>
{/literal}
<h3>{$News.List.Title}</h3>
<em>{$News.List.Date|rusdate:"d m y"}</em><br>
{if $News.List.Icon}
    		<a href="/upload/news/{$News.List.Icon}" target="_blank" onclick="return hs.expand(this)"><img src="/zoom/185x260/upload/news/{$News.List.Icon}" alt="{$News.List.Title}" title="{$News.List.Title}"  align="left"></a>
			<div class="highslide-caption">{$News.List.Date|rusdate:"d m y"} - {$News.List.Title}</div>
{/if}
{$News.List.Content}