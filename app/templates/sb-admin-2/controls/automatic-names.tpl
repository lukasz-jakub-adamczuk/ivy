{if $ctrl eq 'news-image'}<input id="form-{$transfer}-automatic-names" name="options[automatic-names]" type="hidden" value="1">{else}<div class="form-check">
										<input name="options[automatic-names]" type="hidden" value="0" />
										<label for="form-{$transfer}-automatic-names" class="form-check-label">
											<input id="form-{$transfer}-automatic-names" class="form-check-input" name="options[automatic-names]" type="checkbox" value="1"{if isset($aFields['automatic-names']) and $aFields['automatic-names'] eq 1} checked="checked"{/if} />
											Automatyczne nazwy plików
										</label>
										<small class="form-text text-muted">Nazwy ściąganych plików zmienią się podczas zapisywania na serwerze.</small>
									</div>{/if}