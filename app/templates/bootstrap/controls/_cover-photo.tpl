<div class="row">
								<input id="cover-photo-fragment-id" name="fragment[cover][id_fragment]" type="hidden" value="{$aCoverPhoto.id_fragment|default:0}" />
								<input id="cover-photo-fragment-object-id" name="hidden[cover][id_object_fragment]" type="hidden" value="{$aCoverPhoto.id_object_fragment|default:0}" />
								<div class="label">
									<label for="form-cover">Główny obraz</label> <a data-js="choose-image">Wybierz</a>
								</div>
								<!-- <input id="cover-photo-path" name="hidden[path]" type="hidden" value="{$sPath|default:''}" /> -->
								<div>
									<input id="form-cover" name="fragment[cover][fragment]" type="text" class="input" value="{$aCoverPhoto.fragment|default:''}">
								</div>
							</div>
							<div id="cover-photo-div" class="row{if isset($aCoverPhoto) and $aCoverPhoto.fragment neq ''}{else} hidden{/if}">
								<div class="label">
									<label>Podgląd</label>
								</div>
								<div>
									<img id="cover-photo-img" src="{$site}{$aCoverPhoto.fragment|default:''}" style="width: 100%; height: auto;" />
								</div>
							</div>
							{*{else}
							<div class="row">
								<div class="label">
									<b>Główny obraz</b>
								</div>
								<div>
									<p class="tip">Dodawanie głównego obrazu możliwe jest tylko podczas edycji treści.</p>
								</div>
							</div>{/if}
							*}