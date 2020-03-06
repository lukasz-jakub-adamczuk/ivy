{if count($sections) gt 1}
<ul class="nav nav-tabs">
	{foreach from=$sections item=s key=sk}
	<li class="nav-item">
		<a href="{$base}/{$s.url|default:$sk}" class="nav-link{if $sk eq $ctrl or (isset($smarty.get.path) and $sk eq $smarty.get.path)} active{/if}{if isset($counters.$sk) and $counters[$sk].value neq 0} count{/if}" {if isset($counters.$sk) and $counters[$sk].value neq 0} data-count="{$counters[$sk].value}"{/if}>
			{if isset($s.icon)}<span class="tab-icon {$s.icon}"></span>{/if}
			{if isset($s.icon_url)}<span class="tab-icon fav-icon" style="background-image: url({$s.icon_url});"></span>{/if}
			<span class="tab">
				{$s.name}
				{if isset($counters[$sk]) and $counters[$sk].value neq 0}<span class="badge badge-danger badge-counter">{$counters[$sk].value}</span>{/if}
			</span>
		</a>
	</li>
	{/foreach}	
</ul>
{/if}