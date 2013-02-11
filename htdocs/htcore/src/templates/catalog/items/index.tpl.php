<html>
<head>
<title>{$title}</title>
</head>
    {* содержимое группы - позиции *}
    {capture assign="content"}
    {s_catalog action="item" group=$State.Current_item mmid=0}
    {/capture}
<script>
  function setitems()
  {$cDeep.ldelim}
    pw = parent.window.document;
    pw.getElementById('it{$State.Current_item}').innerHTML = "{$content|strip|replace:'\"':'"'|replace:'"':'\"'}";
  {$cDeep.rdelim}
</script>
<body onload="setitems()">
    {$State.Current_item}
	
</body>
</html>