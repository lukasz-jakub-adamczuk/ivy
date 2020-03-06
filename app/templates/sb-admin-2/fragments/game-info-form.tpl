{if isset($aFields.id_fragment_type) and $aFields.id_fragment_type eq 3}<div class="row">
								<div class="label">
									<label for="form-fragment-developer">Studio</label>
								</div>
								<div>
									<input id="form-fragment-developer" name="fragment[developer]" type="text" class="input" value="{$aFragment.developer|default:''}" placeholder="Wpisz odpowiedniego developera" required />
								</div>
							</div>
							<div class="row">
								<div class="label">
									<label for="form-fragment-publisher">Wydawca</label>
								</div>
								<div>
									<input id="form-fragment-publisher" name="fragment[publisher]" type="text" class="input" value="{$aFragment.publisher|default:''}" placeholder="Wpisz odpowiedniego wydawcę" required />
								</div>
							</div>
							<div class="row">
								<div class="label">
									<label for="form-fragment-genre">Gatunek</label>
								</div>
								<div>
									<input id="form-fragment-genre" name="fragment[genre]" type="text" class="input" value="{$aFragment.genre|default:''}" placeholder="Wpisz odpowiedni gatunek" required />
								</div>
							</div>
							<div class="row">
								<div class="label">
									<label for="form-fragment-platform">Platforma</label>
								</div>
								<div>
									<select id="form-fragment-platform" name="hidden[platform]" class="vam">
										<option value="">wybierz</option>
										{foreach from=$aPlatforms item=group key=gk}
										<optgroup label="{$gk}">
											{foreach from=$group item=console key=ck}
											<option value="{$ck}">{$console.abbr}</option>
											{/foreach}
										</optgroup>
										{/foreach}
									</select>
									<span class="vam disabled icon-plus-circle fs-very-large" data-js="add-item" data-item="platform" data-disabled="true"></span>
								</div>
							</div>
							<ul id="sortable-platforms" class="sortable-list">
							{if isset($aFragment.system)}
								{foreach from=$aFragment.system item=fs key=fsk}
									{include file='fragments/game-info-system.tpl'}
								{/foreach}
							{/if}
							</ul>{/if}