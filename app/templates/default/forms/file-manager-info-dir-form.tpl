<form method="post" action="{$base}/{$ctrl}/update-dir" class="table-form">
					<div class="table-row">
						<div class="main-form">
							<input name="path" type="hidden" value="{$sPath}" />
							<input name="oldname" type="hidden" value="{$aFields.name}" />
							<section>
								<div class="row">
									<div class="label">
										<label for="form-name">Bieżący katalog</label>
									</div>
									<div>
										<input id="form-name" name="dataset[name]" type="text" class="input" value="{$aFields.name}" placeholder="Wpisz odpowiednią nazwę" />
									</div>
									<div class="buttons">
										<input name="action[delete]" type="submit" class="button reverse" value="Usuń" />
										<input name="action[save]" type="submit" class="button color" value="Zmień nazwę" />
									</div>
								</div>
							</section>
							{include file='else/main-form-fix.tpl'}
						</div>
					</div>
				</form>