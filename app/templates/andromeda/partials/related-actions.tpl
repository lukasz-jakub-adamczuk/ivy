{if $relatedActions}
<div class="dib ml">
{foreach from=$relatedActions item=ra key=rak}
    <a href="{$base}/{$ra.href|replace:'{$ctrl}':$ctrl}" class="{$ra.class} icon-{$ra.icon}"{if isset($ra.title)} title="{$ra.title}"{/if}>{$ra.name}</a>
{/foreach}
</div>
{/if}