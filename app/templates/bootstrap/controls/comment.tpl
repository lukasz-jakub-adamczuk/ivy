<div class="row">
								<div class="label">
									<label for="form-comment">Treść</label> <a class="icon-arrow-{if isset($visible) and $visible eq false}down{else}up{/if}" data-js="toggle-form-control"></a><span>Treść komentarza</span>
								</div>
								<div{if isset($visible) and $visible eq false} class="visually-hidden"{/if}>
									<textarea id="form-comment" name="dataset[comment]" rows="10" cols="40" class="input" placeholder="Wpisz treść jako HTML">{$aFields.comment|stripslashes|default:''}</textarea>
								</div>
							</div>