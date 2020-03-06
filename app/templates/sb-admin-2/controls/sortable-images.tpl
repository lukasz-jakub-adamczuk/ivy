<div id="sortable-images" class="sortable-items flex" style="display: flex; flex-flow: row wrap; justify-content: flex-start; padding: 10px;">
{if isset($aImages)}
	{foreach from=$aImages item=img key=ik}
	<div class="img-box">
		{*<figure class="thumbnail">
			<a href="{$base}/{$type}-image/{$ik}/remove" class="icon-close" data-js="remove"></a>
			<img width="128" height="128" data-src="{$site}/image.php?img={$img.name}&size=128x128" data-{$type}-image="{$ik}" data-asset="{$img.name}">
		</figure>*}
		<a href="{$base}/{$type}-image/{$ik}/remove" class="icon-close" data-js="remove">&times;</a>
		{image file=$img.name size=128x128}
	</div>
	{/foreach}
{else}
	<p class="warn">Brak obrazów.</p>
{/if}
</div>