{if isset($aFields.deleted) and $aFields.deleted eq 0}
    <button name="button" type="sumbit" class="btn btn-danger" value="delete" data-js="delete">Usuń</button>
{else}
    <button name="button" type="sumbit" class="btn btn-secondary" value="undelete" data-js="undelete">Przywróć</button>
{/if}