<h2>Panel główny</h2>
<section class="card-deck">
    {foreach from=$aHomeBoxes item=box key=bk}
    <!-- <div class="col-3 mb-3"> -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title">{$box.header}</h3>
                <!-- <span class="vam m-s icon-{$box.icon|default:$bk}"></span> -->
                <p class="card-text">{$aDescriptions.$bk|humanize}</p>
            </div>
            <div class="card-footer">
            {foreach from=$box.links item=link key=lk}
                <a href="{$base}{$link.url}" class="button icon-{$link.icon|default:$lk}">{$link.name}</a>
            {/foreach}
            </div>
        </div>
    </div>
    {if $box@iteration is div by 4}</section><section class="card-deck">{/if}
    {/foreach}
</section>