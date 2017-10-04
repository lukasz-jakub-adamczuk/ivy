<div class="row">
								<div class="label">
									<label for="form-category">Kategoria</label>
								</div>
								<div>
									<select id="form-category" name="dataset[{$cpk}]">
									{foreach from=$categories item=c}
										<option value="{$c.$cpk}" data-category-slug="{$c.slug|default:''}" data-category-abbr="{$c.abbr|default:''}"{if isset($aFields.$cpk) and $c.$cpk eq $aFields.$cpk} selected="selected"{/if}>{$c.name}</option>
									{/foreach}
									</select>
									{if isset($aFields.$cpk)}
										{foreach from=$categories item=c}
											{if isset($aFields.$cpk) and $c.$cpk eq $aFields.$cpk}<input id="form-category-slug" name="hidden[category]" type="hidden" value="{$c.name|stripslashes}">
											<input id="form-category-abbr" name="hidden[abbr]" type="hidden" value="{$c.abbr}">{/if}
										{/foreach}
									{/if}
								</div>
							</div>