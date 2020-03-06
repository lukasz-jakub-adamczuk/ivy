<form id="upload-file-form" method="post" action="{$base}/file-manager/upload-file" class="form" enctype="multipart/form-data">
	<div class="col">
		<div class="row">
			<input id="upload-form-path" name="path" type="hidden" value="{$path|default:''}" />
			<div class="form-group">
				<label for="form-urls">Nowy plik lub pliki</label>
				<input id="form-files" name="files[]" type="file" class="input" multiple />
				<small class="form-text text-muted">Lista obrazów w sieci jako urle</small>
			</div>
		</div>
		<div class="row">
			
			{*<div class="row">
				<div class="label">
					<label for="form-name">Nowa nazwa</label>
				</div>
				<div>
					<input id="form-name" name="dataset[name]" type="input" class="input" />
					<p class="tip">
						Nowa nazwa odnosi się do pliku po wgraniu na serwer. Działa tylko w przypadku <b>jednego</b> pliku!
					</p>
				</div>
			</div>*}
			{include file='controls/automatic-names.tpl' transfer='upload'}
			{include file='controls/create-fragments.tpl' transfer='upload'}
		</div>
		<div>
			{if $ctrl eq 'file-manager'}
			<input type="submit" name="action[upload]" class="btn btn-secondary" value="Wgraj" data-js="upload" />
			{else}
			<input type="submit" name="action[upload]" class="btn btn-secondary" value="Wgraj obraz" data-js="upload-image" />
			{/if}
		</div>
	</div>
</form>