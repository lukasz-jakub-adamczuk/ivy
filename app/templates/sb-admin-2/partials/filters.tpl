{if $aFilters}
<form method="post" action="{$base}/{$ctrl}" class="form">
    <div class="form-row">
        {foreach from=$aFilters item=f key=fk}
        <div class="form-group col-md-3">
            <label for="filter-{$fk}">{$f.label}</label>
            {if $f.type eq 'select'}
            <select id="filter-{$fk}" name="nav[{$fk}]" class="form-control">
                {if isset($f.options)}
                {foreach from=$f.options item=fo key=fok}
                    <option value="{$fok}"{if $f.selected === 'null'}{else}{if $fok == $f.selected} selected="selected"{/if}{/if}>{$fo}</option>
                {/foreach}
                {/if}
                {if isset($aFilterValues[$fk])}
                {foreach from=$aFilterValues.$fk item=fo key=fok}
                    <option value="{$fok}"{if $f.selected === 'null'}{else}{if $fok == $f.selected} selected="selected"{/if}{/if}>{$fo}</option>
                {/foreach}
                {/if}
            </select>
            {else}
            <input id="filter-{$fk}" name="nav[{$fk}]" type="{$f.type}" class="form-control" value="{if $f.selected neq 'null'}{$f.selected|default:''}{/if}" />
            {/if}
        </div>
        {/foreach}
        <button type="submit" class="btn btn-primary mb-2">Szukaj</button>
    </div>
</form>
{/if}