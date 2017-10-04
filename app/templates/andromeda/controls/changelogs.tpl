{if isset($aChangeLogs) and count($aChangeLogs) gt 0}
<h3>Historia zmian 
    <a class="interaction-tgr icon-slide-{if isset($visible) and $visible eq false}down{else}up{/if}" data-js="toggle-visibility">toggle</a>
</h3>
<div class="change-logs{if isset($visible) and $visible eq false} vissually-hidden{/if}">
    {foreach from=$aChangeLogs item=cl}
    <div class="row_">
        <!-- <span class="tag tag-{$cl.type}">{$cl.type}</span> -->
        <strong>{$cl.author}</strong>
        {if $cl.type eq 'create'}
            stworzył
        {elseif $cl.type eq 'read'}
            przeczytał
        {elseif $cl.type eq 'update'}
            zmienił
        {elseif $cl.type eq 'delete'}
            usunął
        {/if} wpis
        <time class="text-mutted">{$cl.creation_date|date_format:'%d %B %Y o %H:%M:%S'}</time>
    </div>
    {/foreach}
</div>
{else}
    Brak historii zmian
{/if}