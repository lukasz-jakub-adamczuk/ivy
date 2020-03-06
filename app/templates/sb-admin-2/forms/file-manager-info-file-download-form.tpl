<form id="download-file-form" method="post" action="{$base}/file-manager/download-file" class="form">
	<div class="col">
		<div class="row">
			<input id="download-form-path" name="path" type="hidden" value="{$sPath|default:''}" />
			<div class="form-group">
				<label for="form-urls">Nowy plik lub pliki</label>
				<textarea id="form-urls" name="dataset[urls]" class="form-control" cols="80" rows="5" style="width: 100%;"></textarea>
				<small class="form-text text-muted">Lista obrazów w sieci jako urle</small>
			</div>
		</div>
		<div class="row">
			{include file='controls/automatic-names.tpl' transfer='download'}
			{include file='controls/create-fragments.tpl' transfer='download'}
		</div>
		<div>
			{if $ctrl eq 'file-manager'}
			<button name="action[download]" type="submit" class="btn btn-primary" value="download" data-js="download">Ściągnij</button>
			{else}
			<button name="action[download]" type="submit" class="btn btn-primary" value="download-image" data-js="download-image">Ściągnij obraz</button>
			{/if}
		</div>
	</div>
</form>