<!-- <div class="row"> -->
    <div class="form-component">
        <label for="news-author">Autor</label>        
        <select id="news-author" name="dataset[id_author]" class="form-control">
        {if isset($guestAsAuthor) and $guestAsAuthor}
            <option value="0"{if isset($aFields.id_author) and $aFields.id_author eq 0} selected="selected"{/if}>Autor nieznany</option>
        {/if}
        {if isset($aFields.id_author)}
            {foreach from=$authors item=a key=ak}
                <option value="{$ak}"{if isset($aFields.id_author) and $ak eq $aFields.id_author} selected="selected"{/if}>{$a}</option>
            {/foreach}
        {else}
            <!-- default value as logged in user -->
            {foreach from=$authors item=a key=ak}
                <option value="{$ak}"{if $ak eq $usr::get('id')} selected="selected"{/if}>{$a}</option>
            {/foreach}
        {/if}
        </select>
    </div>
<!-- </div> -->