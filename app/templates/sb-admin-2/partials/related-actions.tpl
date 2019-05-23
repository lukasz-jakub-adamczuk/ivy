{if $relatedActions}
<div class="btn-group_ mr-2" role="group" aria-label="Related actions">
{foreach from=$relatedActions item=ra key=rak}
    <a href="{$base}/{$ra.href|replace:'{$ctrl}':$ctrl}" class="{$ra.class} icon-{$ra.icon}"{if isset($ra.title)} title="{$ra.title}"{/if}>{$ra.name}</a>
{/foreach}
</div>
{/if}