<form id="upload-file-form" method="post" action="{$base}/file-manager/upload-file" class="table-form" enctype="multipart/form-data">
					<div class="table-row">
						<div class="main-form">
							<input id="upload-form-path" name="path" type="hidden" value="{$sPath|default:''}" />
							<section>
								<div class="row">
									<div class="label">
										<label for="form-files">Nowy plik lub pliki</label>
									</div>
									<div>
										<input id="form-files" name="files[]" type="file" class="input" multiple />
									</div>
								</div>
							</section>
						</div>
						<div class="sub-form clearfix">
							<section class="col">
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
							</section>
							<section class="col sticky bg-dark tar desktop-visible relative">
								{if $ctrl eq 'file-manager'}<input type="submit" name="action[upload]" class="button color" value="Wgraj" data-js="upload" />{else}<input type="submit" name="action[upload]" class="button color" value="Wgraj obraz" data-js="upload-image" />{/if}
							</section>
						</div>
					</div>
				</form>