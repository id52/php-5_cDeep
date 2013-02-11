
            {if $State.Path.0.index && ("/`$State.Path.20.index`" !== $State.Current.index)}
            {menu start=$State.Current.index level=1 for='all'}
            {if $Menu}
            <div id=multi-derevo>
            <ul>
              {section loop=$Menu name='m'}
              <li {if $cDeep.section.m.last}class="last"{/if}><span><a href="{$Menu[m].link}">{if $Menu[m].link == $State.Current.index}<em class="marker"></em>{/if}{$Menu[m].title}</a></span>  </li>
              {/section}
            </ul>
            </div>
            {/if}
            {/menu}
            {/if}
