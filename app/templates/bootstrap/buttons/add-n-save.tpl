{if isset($sFormMode) and ($sFormMode eq 'update' or $sFormMode eq 'update-order')}<button name="button" type="sumbit" class="btn btn-primary text color" value="save" data-js="save">Zapisz</button>{else}<button name="button" type="submit" class="btn btn-primary" value="add" data-js="add">Dodaj</button>{/if}