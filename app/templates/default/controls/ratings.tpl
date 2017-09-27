<div class="row">
	<div class="label">
		<label for="form-rating">Ocena główna</label>
	</div>
	<div class="justify">
		<input id="form-rating" name="dataset[rating]" type="range" min="1" max="10" step="1" class="score-rating" value="{$aFields.rating|default:''}">
		{if isset($aFields.rating)}<span class="marker">{$aFields.rating}</span>{/if}
	</div>
</div>
<div class="row">
	<div class="label">
		<label>Ocena cząstkowa</label>
	</div>
	<div>
		{foreach from=$aVerdictSigns item=vs key=vsk}
			<input id="form-sign-opt-{$vsk}" name="dataset[sign]" type="radio" value="{$vsk}"{if isset($aFields.sign) and $vsk eq $aFields.sign} checked="checked"{/if}><label for="form-sign-opt-{$vsk}">{$vs}</label>
		{/foreach}
	</div>
</div>