    <div class="form-group">
        <label for="form-markup">Treść (markup)</label>
        <a class="interaction-tgr icon-slide-{if isset($visible) and $visible eq false}down{else}up{/if}" data-js="toggle-visibility"></a>
    </div>
    <div{if isset($visible) and $visible eq false} class="form-group visually-hidden"{/if}>
        <textarea id="form-markup" name="dataset[markup]" rows="10" cols="40" class="form-control" placeholder="Wpisz treść jako HTML" aria-describedby="markup-help">{$aFields.markup|stripslashes|default:''}</textarea>
        <small id="markup-help" class="form-text text-muted">
            Wartość pola ma najwyższy priorytet przy wyświetlaniu
        </small>
    </div>