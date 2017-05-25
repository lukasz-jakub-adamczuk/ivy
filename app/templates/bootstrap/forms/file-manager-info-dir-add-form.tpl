<form method="post" action="{$base}/{$ctrl}/make-dir" class="table-form">
					<div class="table-row">
						<div class="main-form">
							<input name="path" type="hidden" value="{$sPath}" />
							<section>
								<div class="row">
									<div class="label">
										<label for="form-dir">Nowy katalog</label>
									</div>
									<div>
										<input id="form-dir" name="dataset[dir]" type="text" class="input" value="" placeholder="Wpisz odpowiednią nazwę" />
									</div>
									<div class="buttons">
										<input type="submit" class="button color save" value="Stwórz katalog" />
									</div>
								</div>
							</section>
							{include file='else/main-form-fix.tpl'}
						</div>
					</div>
				</form>