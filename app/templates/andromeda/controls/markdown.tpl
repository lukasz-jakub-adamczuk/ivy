<div class="row">
    <div class="form-component">
        <label for="form-markdown">Treść (markdown)</label>
        <a class="interaction-tgr icon-slide-{if isset($visible) and $visible eq false}down{else}up{/if}" data-js="toggle-visibility"></a>
    </div>
    <div{if isset($visible) and $visible eq false} class="form-component visually-hidden"{/if}>
        <textarea id="form-markdown" name="dataset[markdown]" rows="10" cols="40" class="form-control" placeholder="Wpisz treść jako markdown" aria-describedby="markdown-help">{$aFields.markdown|stripslashes|default:''}</textarea>
        <small id="markdown-help" class="form-text text-muted">
            Wartość pola generuje wynikowy HTML
        </small>
    </div>
</div>