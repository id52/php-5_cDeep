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
			<p class="title">ООО "Мульти-Сервис"</p>
			{include file="tpl.page.404"}
			{include file="tpl.page.405"}
			{include file="tpl.page.406"}
			{include file="tpl.page.407"}
			{include file="tpl.page.408"}
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



			
		</div><!-- /leftCol -->

		<div class="content" style="width: 729px;">
		
			{include file="file:_block/crumbs.tpl.php"}
			{if $State.Current.Topic}<div class="h1"><h1><span>{$State.Current.Topic}</span></h1></div>{/if} 
			{include file="file:_block/subnodes.tpl.php"}
			{$CONTENT}

		
			
		</div><!-- /content -->
	</div><!-- /body -->
	{include file="file:_block/footer.tpl.php"}
