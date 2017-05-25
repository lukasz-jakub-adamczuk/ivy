<div class="row">
											<div class="label">
												<label for="form-fragment-system-{$fsk|default:'none'}-release-{$region|default:'none'}">{$name}</label>
											</div>
											<div>
												<input id="form-fragment-system-{$fsk|default:'none'}-release-{$region|default:'none'}" name="fragment[system][{$fsk|default:'none'}][release][{$region|default:'none'}]" type="text" class="input datepicker" value="{$aFragment.system[{$fsk|default:'none'}].release[{$region|default:'none'}]|default:''}" placeholder="Wpisz datę wydania" />
											</div>
										</div>