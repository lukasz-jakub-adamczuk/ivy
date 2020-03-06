<div class="row">
								<div class="label">
									<label for="form-fragment-type">Typ</label>
								</div>
								<div>
									<select id="form-fragment-type" name="dataset[id_fragment_type]">
									{foreach from=$aFragmentTypes item=ft key=ftk}
										<option value="{$ftk}"{if isset($aFields.id_fragment_type) and $ftk eq $aFields.id_fragment_type} selected="selected"{/if}{if $ftk neq 3} disabled{/if}>{$aDictionaries['fragment-type'].$ft|default:$ft}</option>
									{/foreach}
									</select>
								</div>
							</div>