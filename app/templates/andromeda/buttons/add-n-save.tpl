{if isset($sFormMode) and $sFormMode eq 'update'}
    <button name="button" type="sumbit" class="btn btn-primary" value="save" data-js="save">Zapisz</button>
{else}
    <button name="button" type="submit" class="button text color" value="add" data-js="add">Dodaj</button>
{/if}