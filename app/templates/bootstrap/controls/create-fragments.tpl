{if isset($showCreateFragmentsOption) && $showCreateFragmentsOption}<div>
										<input name="options[create-fragments]" type="hidden" value="0" />
										<input id="form-create-{$transfer}-fragments" name="options[create-fragments]" type="checkbox" value="1" class="vam"{if isset($aFields['create-fragments']) and $aFields['create-fragments'] eq 1} checked="checked"{else} checked="checked"{/if} /><label for="form-create-{$transfer}-fragments" class="vam">Utwórz fragmenty</label>
										<p class="tip">Wszytkie obrazy będą miały wygenerowane fragmenty typu <strong>Główny obraz</strong>.</p>
									</div>{/if}