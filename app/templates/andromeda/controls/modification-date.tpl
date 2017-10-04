{if $sFormMode eq 'update'}
<!-- <div class="row"> -->
    <div class="form-component">
        <label for="form-modification-date">Data modyfikacji</label>
        <input id="form-modification-date" name="dataset[modification_date]" type="text" class="form-control" value="{$aFields.modification_date|default:''}" placeholder="Wpisz datę modyfikacji" />
    </div>
<!-- </div> -->
{/if}