<div id="{$type}-image-fragment" class="row">
								<input id="{$type}-image-fragment-id" name="fragment[{$type}][id_fragment]" type="hidden" value="{$aFragmentImage.{$type}.id_fragment|default:0}" />
								<input id="{$type}-image-fragment-object-id" name="hidden[{$type}][id_object_fragment]" type="hidden" value="{$aFragmentImage.{$type}.id_object_fragment|default:0}" />
								<div class="label">
									<label for="form-{$type}-fragment">Główny obraz</label> <a data-js="choose-image-fragment" data-js-action="{$type}">Wybierz</a> {*<a class="red{if isset($aFragmentImage) and $aFragmentImage.{$type}.fragment neq ''}{else} hidden{/if}" data-js="remove-image-fragment" data-js-action="{$type}">Usuń</a>*}
								</div>
								<!-- <input id="{$type}-image-path" name="hidden[path]" type="hidden" value="{$sPath|default:''}" /> -->
								<div>
									<input id="form-{$type}-fragment" name="fragment[{$type}][fragment]" type="text" class="input" value="{$aFragmentImage.{$type}.fragment|default:''}">
								</div>
							</div>
							<div id="{$type}-image-div" class="row{if isset($aFragmentImage) and $aFragmentImage.{$type}.fragment neq ''}{else} hidden{/if}">
								<div class="label">
									<label>Podgląd</label>
								</div>
								<div>
									<figure class="image-fragment-preview">
										<span class="icon-close" data-js="remove-image-fragment" data-js-action="{$type}"></span>
										<img id="{$type}-image-preview" src="{$site}{$aFragmentImage.{$type}.fragment|default:''}" style="width: 100%; height: auto;" />
									</figure>
								</div>
							</div>