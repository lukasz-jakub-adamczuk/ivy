{if count($sections) gt 1}
<ul class="tabs">
	{foreach from=$sections item=s key=sk}
	{if $sk eq $ctrl or (isset($smarty.get.path) and $sk eq $smarty.get.path)}
		<li class="active">
			<span{if isset($counters[$sk]) and $counters[$sk].value neq 0} class="count" data-count="{$counters[$sk].value}"{/if}>
				{if isset($s.icon)}<span class="tab-icon {$s.icon}"></span>{/if}
				{if isset($s.icon_url)}<span class="tab-icon fav-icon" style="background-image: url({$s.icon_url});"></span>{/if}
				<span class="tab-label">{$s.name}</span>
			</span>
		</li>
	{else}
		<li>
			<a href="{$base}/{$s.url|default:$sk}"{if isset($counters.$sk) and $counters[$sk].value neq 0} class="count" data-count="{$counters[$sk].value}"{/if}>
				{if isset($s.icon)}<span class="tab-icon {$s.icon}"></span>{/if}
				{if isset($s.icon_url)}<span class="tab-icon fav-icon" style="background-image: url({$s.icon_url});"></span>{/if}
				<span class="tab-label">{$s.name}</span>
			</a>
		</li>
	{/if}
	{/foreach}	
</ul>
{/if}