{s_vote }
{if $Vote.title}

<h3>{$Vote.title}</h3>
{if $Vote.voted || $AREQUEST.1=='results'}



<div id="vote">
{foreach from=$Vote.stat key="Question" item="Result"}
  <div class="result"><label title="голосов: {$Result.num}">{$Question}: {$Result.percent|truncate:4:""}%</label><span style="width:{$Result.percent}%;"></span></div>
  <img width="{$Result.percent*2}" height="12" src="/images/root/vote.gif">
{/foreach}
<p>Всего голосов: {$Vote.all}</p>           
</div>
{else}
<form id="opros" method="POST" action="">{* action="/vote/results.xml" *}
{foreach from=$Vote.quest item="Question" name="q"}
{if $Question}
  <input type="radio" class="field radio" id="q{$cDeep.foreach.q.iteration}" name="result" value="{$Question}" />
    <label class="choice" for="q{$cDeep.foreach.q.iteration}">{$Question}</label>
{/if}
{/foreach}
    <div class="send">
    <div style="float:left; margin-right:7px;" class="buttons"><img src="/images/button_left.gif" height="24" width="8" /><button type="submit">Ответить</button><img src="/images/button_right.gif" height="24" width="8" /></div></div>
</form>
{/if}
{/if}
