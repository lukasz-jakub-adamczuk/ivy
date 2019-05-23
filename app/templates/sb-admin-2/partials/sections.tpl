{if count($sections) gt 1}
<ul class="nav nav-tabs">
	{foreach from=$sections item=s key=sk}
	<li class="nav-item">
		<a href="{$base}/{$s.url|default:$sk}"{if isset($counters.$sk) and $counters[$sk].value neq 0} class="count" data-count="{$counters[$sk].value}"{/if}>
			{if isset($s.icon)}<span class="tab-icon {$s.icon}"></span>{/if}
			{if isset($s.icon_url)}<span class="tab-icon fav-icon" style="background-image: url({$s.icon_url});"></span>{/if}
			<span class="nav-link{if $sk eq $ctrl or (isset($smarty.get.path) and $sk eq $smarty.get.path)} active{/if}">
				{$s.name}
				{if isset($counters[$sk]) and $counters[$sk].value neq 0}<span class="badge badge-secondary">{$counters[$sk].value}</span>{/if}
			</span>
		</a>
	</li>
	{/foreach}	
</ul>
{/if}