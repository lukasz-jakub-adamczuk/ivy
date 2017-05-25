{if $sFormMode eq 'update'}<div class="row">
								<div class="label">
									<label for="form-modification-date">Data modyfikacji</label>
								</div>
								<div>
									<input id="form-modification-date" name="dataset[modification_date]" type="text" class="input" value="{$aFields.modification_date|default:''}" placeholder="Wpisz datę modyfikacji" />
								</div>
							</div>{/if}