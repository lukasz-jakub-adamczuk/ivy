<div class="row">
								<div class="label">
									<label for="form-category">Kategoria</label>
								</div>
								<div>
									<select id="form-category" name="dataset[id_type]">
									{foreach from=$aCategories item=c}
										<option value="{$c.id_type}"{if $c.id_type eq $aFields.id_type} selected="selected"{/if}>{$c.name}</option>
									{/foreach}
									{foreach from=$aCategories item=c}
										{if $c.id_type eq $aFields.id_type}<input id="form-category-slug" name="hidden[category]" type="hidden" value="{$c.name|stripslashes}">{/if}
									{/foreach}
									</select>
								</div>
							</div>