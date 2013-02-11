<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 

<link href="/css/reset.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/generic.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/print.css" type="text/css" rel="stylesheet" media="print" />
<link href="/css/layout.css" type="text/css" rel="stylesheet" media="all" />

{loader action=print}

<!--[if IE]>
<link href="/css/ie.css" type="text/css" rel="stylesheet" media="all" />
<![endif]-->
<!--[if lte IE 6]><script src="/js/min-width.js" type="text/javascript"></script><![endif]-->

</head> 
<body> 
<div id="site">

<div id="header">
    <div class="logotype">
    <a href="/"><img src="/images/logo.gif" alt="Бест 2000" /></a>
    <p>г. Томск, пр. Ленина, 41, оф. 5, тел.: 56-29-76, 56-43-65</p>
    <div class="hround hright"></div>
    </div>

    <div class="menu">
            <ul>
            <li class="{if $State.Current.index == "/"}current{/if} first"><a href="/">Главная</a></li>
            <li>|</li>
            {menu start='/' level=3 for='all'}
            {section loop=$Menu name='m'}
            <li class="{if "/`$State.Path.0.index`" == $Menu[m].link}current {/if}{if $cDeep.section.m.last}last {/if}">
                
            <a  href="{$Menu[m].link}">{$Menu[m].title}
            {if $Menu[m].SUB}
                <!--[if IE 7]><!--></a><!--<![endif]-->
                <!--[if lte IE 6]><table><tr><td><![endif]-->
                <ul>
                    {section loop=$Menu[m].SUB name='subMenu'}
                    <li><a href="{$Menu[m].SUB[subMenu].link}">{$Menu[m].SUB[subMenu].title}
                            {if $Menu[m].SUB[subMenu].SUB}
                            <!--[if IE 7]><!--></a><!--<![endif]-->
                            <!--[if lte IE 6]><table><tr><td><![endif]-->
                            <ul>
                                {foreach from=$Menu[m].SUB[subMenu].SUB item='subMenu'}
                                <li><a href="{$subMenu.link}">{$subMenu.title}</a></li>
                                {/foreach}
                            </ul>               
                            <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                            {else}</a>{/if}                   
                    </li>
                    {/section}
                </ul>               
                <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                {elseif $Menu[m].link == '/catalog/'}
                  {s_catalog action="menu" group=0 mmid=0}
                  <!--[if IE 7]><!--></a><!--<![endif]-->
                  <!--[if lte IE 6]><table><tr><td><![endif]-->
                  <ul>
                  {foreach from=$Cat item='catItem' key='catKey'}
                    <li><a href="{$Menu[m].link}{$catItem.mid}/">{$catItem.mname}</a></li>  
                  {/foreach}
                  </ul>
                  <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                {else}</a>{/if}
            </li>
            {if !$cDeep.section.m.last}<li>|</li>{/if}
            {/section}
            {/menu}
    </ul>
    </div>

    <div id="fastsearch">
    <div class="hround hleft"></div>
      <form action="/catalog/" method="get" name="fastsearch-form" id="fastsearch-form" >
        <div>{literal}
            <input name="search" type="text" id="search" class="search" value="поиск по каталогу" onBlur="if(this.value==''){this.value='поиск по каталогу'; this.style.color='#ccc'}" onFocus="if(this.value=='поиск по каталогу'){this.value='';} this.style.color='#000'" />
        </div>{/literal}
        <div class="button">
          <button type="submit" name="Submit">&nbsp;</button>
        </div>
      </form>
    </div>
</div>


<div class="colmask holygrail"> 
    <div class="colmid"> 
        <div class="colleft"> 
            <div class="col1wrap"> 
                <div class="col1"> 
                    <div id="globalnav">
                    {if count($State.Path) > 1}
                    {foreach from=$State.Path name='Crumbs' item='Page'}
                    {if $cDeep.foreach.Crumbs.last}
                      {$Page.Title}
                    {else}
                      <a href="/{$Page.index}">{$Page.Title}</a>&rarr;
                    {/if}
                    {/foreach}
                    {/if}
                    
                    {if $State.Path.0.index=="catalog/"}
                      {if $State.Item.0}<a href="/catalog/">{$State.Current.Title}</a>&rarr;{/if}
                      {foreach from=$State.Item item='i' name='Crumbs'}
                      {s_catalog action="selfgroup" group=$i mmid=0} 
                      {assign var="lnk" value="`$lnk``$i`/"}
                        {if $cDeep.foreach.Crumbs.last}
                          <span>{$Groups.mname}</span>
                      {else}
                          <a href="/catalog/{$lnk}">{$Groups.mname}</a>&rarr; 
                      {/if}
                      {/foreach}
                    {/if} 
                    </div>
                    <!-- Column 1 start --> 
                    <h1>{$State.Current.Title}</h1>
                    {if $State.Path.0.index && ("/`$State.Path.2.index`" !== $State.Current.index)}
                    {menu start=$State.Current.index level=1 for='all'}
                    <ul>
                    {section loop=$Menu name='m'}
                    <li><a href="{$Menu[m].link}">{$Menu[m].title}</a></li>
                    {/section}
                    </ul>
                    {/menu}
                    {/if} 
                    {$CONTENT}
                    <!-- Column 1 end --> 
                </div> 
            </div> 
            <div class="col2"> 
                <!-- Column 2 start --> 
                <h2>Каталог</h2>
                  {s_catalog action="menu" group=0 mmid=0}
                  <ul>
                  {foreach from=$Cat item='catItem' key='catKey'}
                    <li><a href="{$Menu[m].link}{$catItem.mid}/">{$catItem.mname}</a></li>  
                  {/foreach}
                  </ul>
                  
                <h2>Прайс</h2>
                <p>It doesn't matter which column has the longest content, the background colour of all columns will stretch down to meet the footer. This feature was traditionally only available with table based layouts but now with a little CSS trickery we can do exactly the same with divs. Say goodbye to annoying short columns!</p>                
                <!-- Column 2 end --> 
            </div> 
            <div class="col3"> 
                <!-- Column 3 start --> 
                <h2>Помощь в выборе товаров</h2> 
                <p>It doesn't matter which column has the longest content, the background colour of all columns will stretch down to meet the footer. This feature was traditionally only available with table based layouts but now with a little CSS trickery we can do exactly the same with divs. Say goodbye to annoying short columns!</p> 
                <h2>Новости</h2>
                <p>It doesn't matter which column has the longest content, the background colour of all columns will stretch down to meet the footer. This feature was traditionally only available with table based layouts but now with a little CSS trickery we can do exactly the same with divs. Say goodbye to annoying short columns!</p> 
                <!-- Column 3 end --> 
            </div> 
        </div> 
    </div> 
</div> 

<div class="colmask leftmenu"> 
    <div class="colright"> 
        <div class="col1wrap"> 
            <div class="col1"> 
                <!-- Column 2 start --> 
                <h2>Full cross-browser support</h2> 
                <p>The holy grail 3 column liquid Layout has been tested on the following browsers:</p> 
 
                <h3>iPhone &amp; iPod Touch</h3> 
                <ul> 
                    <li>Safari</li> 
                </ul> 
                <h3>Mac</h3> 
                <ul> 
                    <li>Safari</li> 
                    <li>Firefox</li> 
                    <li>Opera 9.25</li> 
                    <li>Netscape 9.0.0.5 &amp; 7.1</li> 
                </ul> 
                <h3>Windows</h3> 
                <ul> 
                    <li>Firefox 1.5 &amp; 2</li> 
 
                    <li>Safari</li> 
                    <li>Opera 8.1 &amp; 9</li> 
                    <li>Explorer 5.5, 6 &amp; 7</li> 
                    <li>Netscape 8</li> 
                </ul> 
                <!-- Column 2 end --> 
            </div> 
        </div> 
        <div class="col2"> 
            <!-- Column 1 start --> 
            <h2>SEO friendly</h2> 
            <p>The higher up content is in your page code, the more important it is considered by search engine algorithms. To make your website as optimised as possible your main page content must come before the side columns. This layout does exactly that: The center page comes first, then the left column and finally the right column (see the nested div structure diagram for more info). The columns can also be configured to any other order if required.</p> 
            <!-- Column 1 end --> 
        </div> 
    </div> 
</div> 

<div class="colmask fullpage"> 
    <div class="col1"> 
        <!-- Column 1 start --> 
        <h2>FREE for anyone to use</h2> 
        <p>You don't have to pay anything. Simply view the source of this page and save the HTML onto your computer. My only suggestion is to <a href="http://matthewjamestaylor.com/blog/adding-css-to-html-with-link-embed-inline-and-import">put the CSS into a separate file</a>. If you are feeling generous however, link back to this page so other people can find and use this layout too.</p> 
        <!-- Column 1 end --> 
    </div> 
</div> 


<div id="footer"> 
    <p>меню</p> 
</div> 
</div>
</body> 
</html>