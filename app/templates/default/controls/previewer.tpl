{if $sFormMode eq 'update'}
	{foreach from=$aCategories item=c}
		{if isset($aFields[$aPreviewer.url.category]) and $c[$aPreviewer.url.category] eq $aFields[$aPreviewer.url.category]}
			{assign "category" $c.slug}
		{/if}
	{/foreach}
	{assign "slug" $aFields[$aPreviewer.url.slug]}

	{if isset($aPreviewer)}
	<input id="form-resource-url" type="hidden" value="{$aPreviewer.url}">
		<a href="{$aPreviewer.pattern|replace:"ctrl":$aPreviewer.url.ctrl|replace:"category":$category|replace:"slug":$slug}">zobacz tekst na stronie</a>
	{/if}
{/if}