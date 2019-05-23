{include file='partials/index-header.tpl' header=$header|default:$sections.$ctrl.name}
{include file='partials/sections.tpl'}
<section class="container">
    <!-- <a href="{$base}/{$ctrl}/add">Nowy wpis</a> -->
    {include file='partials/filters.tpl'}
    
    {include file='partials/pagination.tpl'}
    <form method="post" action="{$base}/{$ctrl}">
        <div class="nav-bar border-top border-bottom bg-almost-white">
            {include file='partials/mass-actions.tpl'}
            {include file='partials/related-actions.tpl'}
        </div>

        <ul class="list-group">
            {foreach from=$list item=item key=ik}
            <li class="list-group-item{if $item.visible eq 0} list-group-item-secondary{/if}">
                <input id="item-{$ik}" name="ids[]" type="checkbox" value="{$item.$sPrimaryKey}" class="list-checkbox mass-checkbox">
                <div>
                    <div class="list-header">
                        <span class="_vam">{$item.author|default:'Gość'}</span>
                        <time class="gray">{$item.creation_date}</time>
                        <a href="{$site}/{url config=$preview item=$item}#komentarz-{$item.$sPrimaryKey}" class="dark mobile-single-line">{if isset($item.category_name)}{$item.category_name} /{/if} {$item.object_name}</a>
                    </div>
                    <label for="item-{$item.$sPrimaryKey}" class="list-label{if $item.visible eq 0} red{/if}">{$item.comment|stripslashes}
                        <p class="relative">
                            <a href="{$base}/{$ctrl}/{$item.$sPrimaryKey}" data-js="fast-edit">Edytuj</a> - <a href="{$base}/{$ctrl}/{$item.$sPrimaryKey}/accept" data-js="accept">Zaakceptuj</a> - <a href="{$base}/{$ctrl}/{$item.$sPrimaryKey}/remove" data-js="remove"class="red">Usuń</a>
                        </p>
                    </label>
                </div>
            </li>
            {/foreach}
        </ul>
        
        <div class="nav-bar border-bottom bg-almost-white">
            {include file='partials/mass-actions.tpl'}
        </div>
    </form>
    {include file='partials/pagination.tpl'}
</section>