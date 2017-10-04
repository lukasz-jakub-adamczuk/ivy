{if $relatedActions}
						<div class="dib ml">
						{foreach from=$relatedActions item=ra key=rak}
							<a href="{$base}/{$ra.href|replace:'{$ctrl}':$ctrl}" class="button icon-{$ra.icon}{if isset($ra.color)} {$ra.color}{/if}"{if isset($ra.title)} title="{$ra.title}"{/if}></a>
						{/foreach}
						</div>
					{/if}