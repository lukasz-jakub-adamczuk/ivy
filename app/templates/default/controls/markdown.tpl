<div class="row">
								<div class="label">
									<label for="form-markdown">Treść (markdown)</label> <a class="interaction-tgr icon-slide-{if isset($visible) and $visible eq false}down{else}up{/if}" data-js="toggle-visibility"></a><span>Wartość pola generuje wynikowy HTML</span>
								</div>
								<div{if isset($visible) and $visible eq false} class="visually-hidden"{/if}>
									<textarea id="form-markdown" name="dataset[markdown]" rows="10" cols="40" class="input" placeholder="Wpisz treść jako markdown">{$aFields.markdown|stripslashes|default:''}</textarea>
								</div>
							</div>