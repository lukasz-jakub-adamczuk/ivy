<div class="row">
								<div class="label">
									<label for="form-markup">Treść (markup)</label> <a class="interaction-tgr icon-slide-{if isset($visible) and $visible eq false}down{else}up{/if}" data-js="toggle-visibility"></a><span>Wartość pola ma najwyższy priorytet przy wyświetlaniu</span>
								</div>
								<div{if isset($visible) and $visible eq false} class="visually-hidden"{/if}>
									<textarea id="form-markup" name="dataset[markup]" rows="10" cols="40" class="input" placeholder="Wpisz treść jako HTML">{$aFields.markup|stripslashes|default:''}</textarea>
								</div>
							</div>