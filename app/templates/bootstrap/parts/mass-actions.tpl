{if $aMassActions}
						<div class="mass-actions dib btn-group">
						{foreach from=$aMassActions item=ma key=mak}
							<button name="action[{$mak}]" type="submit" value="{$ma.name}" class="btn btn-default{if isset($ma.color)} {$ma.color}{/if}"{if isset($ma.title)} title="{$ma.title}"{/if}>
								<span class="glyphicon glyphicon-{$ma.icon}"></span> {$ma.name}
							</button>
						{/foreach}
						</div>
					{/if}