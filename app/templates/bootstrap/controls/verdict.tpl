<div class="_row form-group">
								<div class="_label">
									<label for="form-verdict">Treść</label><span>Wartość pola jest treścią oceny. HTML jest niedopuszczalny</span>
								</div>
								<div>
									<textarea id="form-verdict" name="dataset[verdict]" rows="10" cols="40" class="form-control" placeholder="Wpisz treść">{$aFields.verdict|stripslashes|default:''}</textarea>
								</div>
							</div>