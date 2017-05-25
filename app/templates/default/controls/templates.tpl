<div class="row">
								<div class="label">
									<label for="form-template">Szablon</label>
								</div>
								<div>
									<select id="form-template" name="dataset[{$tpk}]">
									{foreach from=$aTemplates item=t}
										<option value="{$t.$tpk}"{if isset($aFields.$tpk) and $t.$tpk eq $aFields.$tpk} selected="selected"{/if}>{$t.name}</option>
									{/foreach}
									<option value="__NULL__"{if !isset($aFields.$tpk)} selected="selected"{/if}>Zwykły tekst</option>
									</select>
								</div>
							</div>