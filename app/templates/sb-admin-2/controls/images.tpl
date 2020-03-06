<div id="images" class="row">
        <p style="margin: 0;"></p>
        <div class="label">
            <label>{$label}</label> <a data-js="choose-images" data-js-action="{$type}" data-toggle="modal" data-target="#exampleModal">Wybierz</a>
        </div>
        {if isset($iGalleryImagesTotal)}
            <span>{$iGalleryImagesTotal|pluralize:"obraz":"obrazy":"obrazów"}.</span>
        {else}
            <span>Brak obrazów.</span>
        {/if}
    </div>