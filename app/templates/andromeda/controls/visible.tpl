<div class="form-check">
    <input name="dataset[visible]" type="hidden" value="0" />
    <label for="form-visible" class="form-check-label">
        <input id="form-visible" name="dataset[visible]" type="checkbox" class="form-check-input" value="1"{if isset($aFields.visible) and $aFields.visible eq '1'} checked="checked"{/if}>
        Treść widoczna publicznie
    </label>
</div>