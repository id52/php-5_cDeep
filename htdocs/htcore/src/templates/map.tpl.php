<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$State.Current.TitleMeta} - БЭСТ</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="false" />
<meta name="MSSmartTagsPreventParsing" content="true" />
<meta name="Description" content="{$State.Current.DescriptionHtml}" />
<meta name="Keywords" content="{$State.Current.Keywords}" />

{loader src='test.js' type='js' comment='JQuery'}
{loader src='test.css' base='/css/' type='css'}


{loader action=print}
</head> 
    <body> {news_viewer action="List"}
            <!--<li class="{if $State.Current.index == "/"}current{/if} first"><a href="/">Главная</a></li>-->
                        
            {menu start='/' level=3 for='all'}
            <ul>
            {section loop=$Menu name='m'}
                <!--<li class="{if "/$State.Path.0.index" == $Menu[m].link}current {/if}{if $cDeep.section.m.last}last {/if}"> -->
                <li><a  href="{$Menu[m].link}">{$Menu[m].title}</a>
                    {if $Menu[m].link=='/news/'}
                        <ul>
                           {foreach from=$News.List item="New"}
                           <li><a class="ntitle" href="/news/{$New.id}.html">{$New.Title}</a></li>
                                        <!--{$New.Description}-->
                           {/foreach}     
                        </ul>
                    {/if}
                    
                    
                    
                    
                    
                    {if $Menu[m].link=='/photo/'}
                    <ul>
                        {foreach from=$gallerys item="gallery"}
                        <li><a href="/photo/{$gallery.id}.xml">{$gallery.fio}</a></li>
                        {/foreach}
                    </ul>
                    {/if}
                    
                    
                    
                    
                    
                    {if $Menu[m].SUB }{*|| $Menu[m].link == '/catalog/'*}
                    {section loop=$Menu[m].SUB name='subMenu'}
                        <ul>
                            <li>  <a href="{$Menu[m].SUB[subMenu].link}"> {$Menu[m].SUB[subMenu].title}</a></li>
                                    {if $Menu[m].SUB[subMenu].SUB}
                                        <ul>
                                                {foreach from=$Menu[m].SUB[subMenu].SUB item='subMenu'}
                                                <li> <a href="{$subMenu.link}"> {$subMenu.title}</a></li>
                                                {/foreach}
                                        </ul>
                                    {/if}                   
                        </ul>
                    {/section}
                 </li>
                



                    {*s_catalog action="menu" group=0 mmid=0}
                    {foreach from=$Cat item='catItem' key='catKey'}
                        <a href="{$Menu[m].link}{$catItem.mid}/"> {$catItem.mname}</a>
                    {/foreach*}
                {else}</a>{/if}
                {if !$cDeep.section.m.last}{/if}
            {/section}
            </LI></UL>
            {/menu}
