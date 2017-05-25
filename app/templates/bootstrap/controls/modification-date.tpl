{if $sFormMode eq 'update'}<div class="_row form-group">
								<div class="_label">
									<label for="form-modification-date">Data modyfikacji</label>
								</div>
								<div>
									<input id="form-modification-date" name="dataset[modification_date]" type="text" class="form-control" value="{$aFields.modification_date|default:''}" placeholder="Wpisz datę modyfikacji" />
								</div>
							</div>{/if}