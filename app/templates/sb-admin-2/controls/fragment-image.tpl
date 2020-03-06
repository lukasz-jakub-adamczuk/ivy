<div id="{$type}-image-fragment" class="row">
    <input id="{$type}-image-fragment-id" name="fragment[{$type}][id_fragment]" type="hidden" value="{$fragmentImage.{$type}.id_fragment|default:0}" />
    <input id="{$type}-image-fragment-object-id" name="hidden[{$type}][id_object_fragment]" type="hidden" value="{$fragmentImage.{$type}.id_object_fragment|default:0}" />
    <div class="form-label">
        <label for="form-{$type}-fragment">Główny obraz</label>
        <a data-js="choose-image-fragment" data-js-action="{$type}" data-toggle="modal" data-target="#exampleModal">Wybierz</a>
    </div>
    <!-- <input id="{$type}-image-path" name="hidden[path]" type="hidden" value="{$sPath|default:''}" /> -->
    <div class="form-component">
        <input id="form-{$type}-fragment" name="fragment[{$type}][fragment]" type="text" class="form-control" value="{$fragmentImage.{$type}.fragment|default:''}">
    </div>
</div>
<div id="{$type}-image-div" class="row{if isset($fragmentImage) and $fragmentImage.{$type}.fragment neq ''}{else} hidden{/if}">
    <div class="form-label">
        <label>Podgląd</label>
    </div>
    <div class="form-component">
        <figure class="image-fragment-preview">
            <span class="icon-close" data-js="remove-image-fragment" data-js-action="{$type}"></span>
            <!-- <img id="{$type}-image-preview" src="|default:''}" /> -->
            {image file=$fragmentImage.{$type}.fragment size=360x}
        </figure>
    </div>
</div>