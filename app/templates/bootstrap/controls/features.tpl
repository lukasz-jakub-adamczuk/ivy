<div class="_row visually-hidden form-group">
								<div class="_label">
									<label for="form-features">Cechy</label><span>Wartość pola jest zbiorem cech, czyli plusów i minusów podanych przez recenzenta</span>
								</div>
								<div>
									<textarea id="form-features" name="dataset[features]" rows="10" cols="40" class="form-control" placeholder="Wpisz cechy jako JSON">{$aFields.features|stripslashes|default:''}</textarea>
								</div>
							</div>
							<div class="_row form-group">
								<div class="_label">
									<label>Plusy</label><a class="interaction-tgr icon-add" data-js="add-advantage"></a><span>Zalety gry istotne przy podsumowaniu</span>
								</div>
								<div id="form-features-advantages">
									
								</div>
							</div>
							<div class="_row form-group">
								<div class="_label">
									<label>Minusy</label><a class="interaction-tgr icon-add" data-js="add-disadvantage"></a><span>Wady gry istotne przy podsumowaniu</span>
								</div>
								<div id="form-features-disadvantages">
									
								</div>
							</div>