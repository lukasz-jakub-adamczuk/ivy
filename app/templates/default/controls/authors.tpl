<div class="row">
	<div class="label">
		<label for="news-author">Autor</label>
	</div>
	<div>
		<select id="news-author" name="dataset[id_author]">
		{if isset($aFields.id_author)}
			{foreach from=$authors item=a key=ak}
				<option value="{$ak}"{if isset($aFields.id_author) and $ak eq $aFields.id_author} selected="selected"{/if}>{$a}</option>
			{/foreach}
		{else}
			{foreach from=$authors item=a key=ak}
				<option value="{$ak}"{if $ak eq $usr::get('id')} selected="selected"{/if}>{$a}</option>
			{/foreach}
		{/if}
		</select>
	</div>
</div>