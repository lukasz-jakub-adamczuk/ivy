{if $ctrl eq 'news-image'}<input id="form-{$transfer}-automatic-names" name="options[automatic-names]" type="hidden" value="1">{else}<div>
										<input name="options[automatic-names]" type="hidden" value="0" />
										<input id="form-{$transfer}-automatic-names" name="options[automatic-names]" type="checkbox" value="1" class="vam"{if isset($aFields['automatic-names']) and $aFields['automatic-names'] eq 1} checked="checked"{/if} /><label for="form-{$transfer}-automatic-names" class="vam">Automatyczne nazwy plików</label>
										<p class="tip">Nazwy ściąganych plików zmienią się podczas zapisywania na serwerze.</p>
									</div>{/if}