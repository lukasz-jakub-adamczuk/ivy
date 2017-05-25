{if count($aSections) gt 1}
			<ul class="nav nav-tabs">
				{foreach from=$aSections item=s key=sk}
				{if $sk eq $ctrl or (isset($smarty.get.path) and $sk eq $smarty.get.path)}
					<li class="active">
						<a{if isset($aCounters[$sk]) and $aCounters[$sk].value neq 0} class="count" data-count="{$aCounters[$sk].value}"{/if}>
							{if isset($s.icon)}<span class="tab-icon {$s.icon}"></span>{/if}
							{if isset($s.icon_url)}<span class="tab-icon fav-icon" style="background-image: url({$s.icon_url});"></span>{/if}
							<span class="tab-label">{$s.name}</span>
						</a>
					</li>
				{else}
					<li>
						<a href="{$base}/{$s.url|default:$sk}"{if isset($aCounters.$sk) and $aCounters[$sk].value neq 0} class="count" data-count="{$aCounters[$sk].value }"{/if}>
							{if isset($s.icon)}<span class="tab-icon {$s.icon}"></span>{/if}
							{if isset($s.icon_url)}<span class="tab-icon fav-icon" style="background-image: url({$s.icon_url});"></span>{/if}
							<span class="tab-label">{$s.name}</span>
						</a>
					</li>
				{/if}
				{/foreach}	
			</ul>
			{/if}