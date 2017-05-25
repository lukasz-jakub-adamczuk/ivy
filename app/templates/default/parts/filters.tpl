{if $aFilters}				<form method="post" action="{$base}/{$ctrl}" class="filters">
					{foreach from=$aFilters item=f key=fk}
					<span class="filter">
					<label for="filter-{$fk}">{$f.label}</label>
					{if $f.type eq 'select'}
					<select id="filter-{$fk}" name="nav[{$fk}]">
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
					<input id="filter-{$fk}" name="nav[{$fk}]" type="{$f.type}" value="{if $f.selected neq 'null'}{$f.selected|default:''}{/if}" />
					{/if}
					</span>
					{/foreach}
					<button type="submit" class="button color icon-search"></button>
				</form>{/if}