{foreach from=$list item=elem key=ek}
<li>
    <div class="item">
        <select id="item-{$ek}" name="ids[{$ek}]">
        {foreach from=$aOptions item=opt key=ok}
            <option value="{$opt}"{if $opt eq $elem.idx} selected="selected"{/if}>{$opt}</option>
        {/foreach}
        </select>
        {if isset($elem.name)}
            {$elem.name}
        {elseif isset($elem.title)}
            {$elem.title}
        {/if}
    </div>
</li>
{/foreach}