<form id="download-file-form" method="post" action="{$base}/file-manager/download-file" class="table-form">
					<div class="table-row">
						<div class="main-form">
							<input id="download-form-path" name="path" type="hidden" value="{$sPath|default:''}" />
							<section>
								<div class="row">
									<div class="label">
										<label for="form-urls">Nowy plik lub pliki</label><span>Lista obrazów w sieci jako urle</span>
									</div>
									<div>
										<textarea id="form-urls" name="dataset[urls]" class="input" cols="80" rows="5"></textarea>
									</div>
								</div>
							</section>
							{include file='else/main-form-fix.tpl'}
						</div>
						<div class="sub-form clearfix">
							<section class="col">
								{include file='controls/automatic-names.tpl' transfer='download'}
								{include file='controls/create-fragments.tpl' transfer='download'}
							</section>
							<section class="col sticky bg-dark tar desktop-visible relative">
								{if $ctrl eq 'file-manager'}<button name="action[download]" type="submit" class="button text color" value="download" data-js="download">Ściągnij</button>{else}<button name="action[download]" type="submit" class="button text color" value="download-image" data-js="download-image">Ściągnij obraz</button>{/if}

							</section>
						</div>
					</div>
				</form>