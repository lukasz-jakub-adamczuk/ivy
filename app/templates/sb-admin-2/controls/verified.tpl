<div class="form-check">
    <input name="dataset[verified]" type="hidden" value="0" />
    <label for="form-verified" class="form-check-label">
        <input id="form-verified" name="dataset[verified]" type="checkbox" class="form-check-input" value="1"{if isset($aFields.verified) and $aFields.verified eq 1} checked="checked"{/if} />
        Treść zgodna ze standardami
    </label>
</div>