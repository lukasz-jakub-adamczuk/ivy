{if $aLogs}
<div class="debug">
    <strong>DEBUG CONSOLE</strong>
    
    <div class="list-group">
        {foreach from=$console.queries item=q}
        <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                {if isset($q.header)}<h5 class="mb-1">{$q.header}</h5>{/if}
                {if isset($q.meta)}<small>{$q.meta}</small>{/if}
            </div>
            {if isset($q.content)}<p class="mb-1">{$q.content}</p>{/if}
            {if isset($q.subcontent)}<small>{$q.subcontent.s}s ({$q.subcontent.ms}ms)</small>{/if}
        </a>
        {/foreach}
    </div>
    
    {if isset($smarty.session._params_.console)}
        <a id="console-tgr" href="{$base}/{$ctrl}/reset/console" data-href="{$base}/{$ctrl}/set/console/1">Konsola (ukryj)</a>
    {else}
        <a id="console-tgr" href="{$base}/{$ctrl}/set/console/1" data-href="{$base}/{$ctrl}/reset/console">Konsola (pokaż)</a>
    {/if}
    <!-- <div class="stack"{if !isset($smarty.session._params_.console)} style="display: none;"{/if}> -->
    <div class="stack" style="display: none;">
        {foreach from=$aLogs item=log}
        <div{if isset($log.logtype)} class="{$log.logtype}"{/if}>
            <p><span class="line"><strong>{$log.line}</strong></span><span class="file" title="{$log.file}">{$log.file_short}</span><span class="name">{$log.name|default:'unknown'}</span></p>
            {*if $log.array}
            <p><pre>{$log.var}</pre></p>
            {else*}
            <p>{$log.var}</p>
            {*/if*}
        </div>
        {/foreach}
    </div>
    
</div>
{/if}