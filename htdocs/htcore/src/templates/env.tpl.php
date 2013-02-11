{include file="file:_block/header.tpl.php"}
{include file='file:catalog/cart.tpl.php'}		
{address}
<div class="page">
	<div class="header">
	<div class="headerIn clear">
		<div class="logo">
			<a href="/" title=""></a>
		</div>
		<div class="topContacts">
			{include file="tpl.page.403"}
		</div>
	</div><!-- /headerIn -->
	</div><!-- /header -->

	    <div class="topmenu">
           		<ul class="clear">
            <li class="{if $State.Current.index == "/"}active{/if}"><a href="/">Главная</a></li>
            
            {menu start='/' level=0 for='all'}
            {section loop=$Menu name='m'}
            <li class="{if "/`$State.Path.0.index`" == $Menu[m].link}active {/if}">
				<a  href="{$Menu[m].link}">{$Menu[m].title}</a>
            
            
            {/section}
            {/menu}
    </ul>
    </div>
	
	
	<div class="body clear">
		{literal}
		<div class="leftCol">
			<div class="leftSearch">
				<form method="get" action="/catalog/">
				<fieldset >
					<input name='search' type="text" value="в каталоге" id="" size="20" class="search_input" onclick="if(this.value=='в каталоге'){this.value=''}" onblur="if(this.value==''){this.value='в каталоге'}" />
					<input type="submit" class="search_but" value="НАЙТИ" />
				</fieldset>
				</form>
			</div>
			{/literal}
			
			
            {include file='file:_block/sidecatalog.tpl.php'}
			{include file='file:news/main.tpl.php'}
			<br>
			<div class="leftnews"> 
			<p class="header">Личный кабинет</p>
			<div class="leftnewsT">
			<div class="leftnewsB" style="padding:20px;">
			{include file='file:passport/authorization.tpl.php'}	
			</div>
			</div>
			</div>
			
			
			
			<div class="leftnews"> 
			<p class="header">Произвольное видео</p>
			<div class="leftnewsT">
			<div class="leftnewsB" style="padding:20px;">
			{include file="file:photo/videorandom.tpl.php"}
			</div>
			</div>
			</div>
			
			<div class="leftnews"> 
			<p class="header">Произвольное фото</p>
			<div class="leftnewsT">
			<div class="leftnewsB" style="padding:20px;">
			{include file="file:photo/photorandom.tpl.php"}
			</div>
			</div>
			</div>
			<div class="leftnews"> 
			<p class="header">Опрос</p>
			<div class="leftnewsT">
			<div class="leftnewsB" style="padding:20px;">
			{include file="file:vote/index.tpl.php"}
			</div>
			</div>
			</div>
			


		</div><!-- /leftCol -->

		<div class="content">
			{include file="file:_block/crumbs.tpl.php"}
			{if $State.Current.Topic}<div class="h1"><h1><span>{$State.Current.Topic}</span></h1></div>{/if} 
			{include file="file:_block/subnodes.tpl.php"}
			{$CONTENT}

			
		</div><!-- /content -->
		
		<div class="rightCol">
			<div class="newprods">
				<img src="/images/title_new.png" alt="title_new" width="229" height="72" />
				
					{include file="file:catalog/main.tpl.php"}
				
			</div>
		</div><!-- /rightCol -->
	</div><!-- /body -->
	{include file="file:_block/footer.tpl.php"}
