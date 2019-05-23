<h2>Panel główny</h2>
<section class="card-group">

    {foreach from=$aHomeBoxes item=box key=bk}
    <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1 d-flex align-items-stretch">
        <div class="card mt-3 mb-3">
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
    
    {/foreach}
</section>