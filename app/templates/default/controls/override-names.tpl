<div>
										<input name="dataset[automatic-names]" type="hidden" value="0" />
										<input id="form-automatic-names" name="dataset[automatic-names]" type="checkbox" value="1"{if isset($aFields['automatic-names']) and $aFields['automatic-names'] eq 1} checked="checked"{/if} /><label for="form-automatic-names">Automatyczne nazwy plików</label>
										<p class="tip">Nazwy ściąganych plików zmienią się podczas zapisywania na serwerze.</p>
									</div>
									{*<div>
										<input name="dataset[override-files]" type="hidden" value="0" />
										<input id="form-override-files" name="dataset[override-files]" type="checkbox" value="1"{if isset($aFields['override-files']) and $aFields['override-files'] eq 1} checked="checked"{/if} /><label for="form-override-files">Nadpisz pliki</label>
										<p>Istniejące pliki zostaną nadpisane podczas ściągania na serwer.</p>
									</div>*}