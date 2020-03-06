<li>
									<span class="close-action icon-close" data-js="remove-item"></span>
									<header>
										<h3 class="vam">{$aDictionaries.system[{$fsk|default:'none'}].abbr|default:''}</h3>
										<span class="vam gray cursor-default icon-slide-down" data-js="toggle-display"></span>
									</header>
									<div class="mt hidden">
										<div class="row">
											<div class="label">
												<label for="form-fragment-system-{$fsk|default:'none'}-media">Nośnik</label>
											</div>
											<div>
												<input id="form-fragment-system-{$fsk|default:'none'}-media" name="fragment[system][{$fsk|default:'none'}][media]" type="text" class="input" value="{$aFragment.system[{$fsk|default:'none'}].media|default:''}" placeholder="Wpisz liczbę i rodzaj nośnika" />
											</div>
										</div>
										{include file='fragments/game-info-release-date.tpl' name='Japonia' region='jp'}
										{include file='fragments/game-info-release-date.tpl' name='Ameryka Północna' region='na'}
										{include file='fragments/game-info-release-date.tpl' name='Europa' region='eu'}
									</div>
								</li>