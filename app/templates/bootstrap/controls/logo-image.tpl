<div id="logo-image-fragment" class="row">
								<input id="logo-image-fragment-id" name="fragment[logo][id_fragment]" type="hidden" value="{$aLogoImage.id_fragment|default:0}" />
								<input id="logo-image-fragment-object-id" name="hidden[logo][id_object_fragment]" type="hidden" value="{$aLogoImage.id_object_fragment|default:0}" />
								<div class="label">
									<label for="form-logo">Logo</label> <a data-js="choose-image-fragment" data-js-action="logo">Wybierz</a>
								</div>
								<!-- <input id="logo-image-path" name="hidden[path]" type="hidden" value="{$sPath|default:''}" /> -->
								<div>
									<input id="form-logo" name="fragment[logo][fragment]" type="text" class="input" value="{$aLogoImage.fragment|default:''}">
								</div>
							</div>
							<div id="logo-image-div" class="row{if isset($aLogoImage) and $aLogoImage.fragment neq ''}{else} hidden{/if}">
								<div class="label">
									<label>Podgląd</label>
								</div>
								<div>
									<img id="logo-image-preview" src="{$site}{$aLogoImage.fragment|default:''}" style="width: 100%; height: auto;" />
								</div>
							</div>