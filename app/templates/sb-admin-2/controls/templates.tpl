<!-- <div class="row"> -->
    <div class="form-group">
        <label for="form-template">Szablon</label>
        <select id="form-template" name="dataset[{$tpk}]" class="form-control">
        {foreach from=$templates item=t}
            <option value="{$t.$tpk}"{if isset($aFields.$tpk) and $t.$tpk eq $aFields.$tpk} selected="selected"{/if}>{$t.name}</option>
        {/foreach}
        <option value="__NULL__"{if !isset($aFields.$tpk)} selected="selected"{/if}>Zwykły tekst</option>
        </select>
    </div>
<!-- </div> -->