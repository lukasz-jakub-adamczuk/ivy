<ul id="sortable-images" class="sortable-items">
{if isset($aImages)}
	{foreach from=$aImages item=img key=ik}<li>
		{*<figure class="thumbnail">
			<a href="{$base}/{$type}-image/{$ik}/remove" class="icon-close" data-js="remove"></a>
			<img width="128" height="128" data-src="{$site}/image.php?img={$img.name}&size=128x128" data-{$type}-image="{$ik}" data-asset="{$img.name}">
		</figure>*}
		<a href="{$base}/{$type}-image/{$ik}/remove" class="icon-close" data-js="remove"></a>
		{image file=$img.name size=128x128}
	</li>{/foreach}
{else}
	<p class="warn">Brak obrazów.</p>
{/if}
</ul>