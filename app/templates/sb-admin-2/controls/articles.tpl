<div class="row">
    <div class="label">
        <label for="form-article">Artykuł (gra)</label>
    </div>
    <div>
        <select id="form-article" name="dataset[id_article]">
        {foreach from=$aArticles item=a}
            <option value="{$a.id_article}"{if isset($aFields.id_article) and $a.id_article eq $aFields.id_article} selected="selected" and $rel.object eq 'article'{/if}>{$a.category} - {$a.title}</option>
        {/foreach}
        </select>
    </div>
</div>