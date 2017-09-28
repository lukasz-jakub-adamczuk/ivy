<div id="logo-image-fragment" class="row">
	<input id="cover-image-fragment-id" name="fragment[cover][id_fragment]" type="hidden" value="{$aCoverImage.id_fragment|default:0}" />
	<input id="cover-image-fragment-object-id" name="hidden[cover][id_object_fragment]" type="hidden" value="{$aCoverImage.id_object_fragment|default:0}" />
	<div class="label">
		...<label for="form-cover">Główny obraz</label> <a data-js="choose-image-fragment" data-js-action="cover">Wybierz</a>
	</div>
	<!-- <input id="cover-image-path" name="hidden[path]" type="hidden" value="{$sPath|default:''}" /> -->
	<div>
		<input id="form-cover" name="fragment[cover][fragment]" type="text" class="input" value="{$aCoverImage.fragment|default:''}">
	</div>
</div>
<div id="cover-image-div" class="row{if isset($aCoverImage) and $aCoverImage.fragment neq ''}{else} hidden{/if}">
	<div class="label">
		<label>Podgląd</label>
	</div>
	<div>
		<img id="cover-image-preview" src="{$site}{$aCoverImage.fragment|default:''}" style="width: 100%; height: auto;" />
	</div>
</div>