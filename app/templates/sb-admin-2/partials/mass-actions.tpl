{if $massActions}
<div class="btn-group_ mr-2" role="group" aria-label="Mass actions">
{foreach from=$massActions item=ma key=mak}
    <button name="action[{$mak}]" type="submit" value="{$ma.name}" class="{$ma.class} icon-{$ma.icon}{if isset($ma.color)} {$ma.color}{/if}"{if isset($ma.title)} title="{$ma.title}"{/if}>{$ma.name}</button>
{/foreach}
</div>
{/if}