<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
{address}
{if $State.titlemeta}<title>{$State.titlemeta} - {$titleend}</title> {/if}
{if $State.keywordsmeta}<meta name="Keywords" content="{$State.keywordsmeta}"> {/if}
{if $State.descriptionmeta}<meta name="Description" content="{$State.descriptionmeta}">{/if}    
{section name=i loop=$State.Path start=-1}
{if !$State.keywordsmeta}<meta name="Keywords" content="{$State.Path[i].keywordsmeta}">{/if}
{if !$State.descriptionmeta}<meta name="Description" content="{$State.Path[i].descriptionmeta}">{/if}
{if !$State.titlemeta}<title>{$State.Path[i].titlemeta} - {$titleend}</title>{/if}
{/section}
<link rel="Stylesheet"  href="/css/style.css" type="text/css" />
<link rel="Stylesheet"  href="/css/tree.css" type="text/css" />
<link rel="Stylesheet"  href="/css/crumbs.css" type="text/css" />
<link rel="Stylesheet"  href="/css/spiski.css" type="text/css" />
<link rel="Stylesheet"  href="/css/forms.css" type="text/css" />
<link rel="Stylesheet"  href="/css/sorting.css" type="text/css" />

<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>


{loader action=print}
</head>


		
