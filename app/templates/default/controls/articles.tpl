<div class="row">
    {if isset($aRelations)}
        {foreach from=$aRelations item=rel}
        <input id="relation-object-fragment-id" name="relations[used][{$rel.id_object_fragment}][id_object_fragment]" type="hidden_" value="{$rel.id_object_fragment|default:0}" />
        <input id="relation-object-id" name="relations[used][{$rel.id_object_fragment}][id_object]" type="hidden_" value="{$rel.id_object|default:0}" />
        <input id="relation-object" name="relations[used][{$rel.id_object_fragment}][object]" type="hidden_" value="{$rel.object}" />
        <div class="label">
            <label for="form-article">Artykuł (gra)</label>
        </div>
        <div>
            <select id="form-article" name="hidden[id_article]">
            {foreach from=$aArticles item=a}
                <option value="{$a.id_article}"{if isset($rel) and $a.id_article eq $rel.id_object} selected="selected" and $rel.object eq 'article'{/if}>{$a.category} - {$a.title}</option>
            {/foreach}
            </select>
            {if isset($aFields.id_article)}
                {foreach from=$aArticles item=a}
                    {if $a.id_article eq $aFields.id_article}
                    <input id="form-article-slug" name="hidden[article]" type="hidden" value="{$a.title|stripslashes}">
                    <input id="form-article-abbr" name="hidden[abbr]" type="hidden" value="{$a.abbr|default:''}">
                    {/if}
                {/foreach}
            {/if}
        </div>
        {/foreach}
    {/if}
    <div class="label">
        <label for="form-article">Artykuł (gra)</label>
    </div>
    <div>
        <select id="form-article" name="dataset[id_article]">
        {foreach from=$aArticles item=a}
            <option value="{$a.id_article}"{if isset($rel) and $a.id_article eq $rel.id_object} selected="selected" and $rel.object eq 'article'{/if}>{$a.category} - {$a.title}</option>
        {/foreach}
        </select>
        {if isset($aFields.id_article)}
            {foreach from=$aArticles item=a}
                {if $a.id_article eq $aFields.id_article}
                    <input id="form-article-slug" name="hidden[article]" type="hidden" value="{$a.title|stripslashes}">
                    <input id="form-article-abbr" name="hidden[abbr]" type="hidden" value="{$a.abbr|default:''}">
                {/if}
            {/foreach}
        {/if}
    </div>
</div>