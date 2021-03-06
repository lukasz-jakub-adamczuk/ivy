{include file='partials/index-header.tpl' header=$header|default:$sections.$ctrl.name}
{include file='partials/sections.tpl'}
<section class="container">
    <form method="post" action="{$base}/{$ctrl}">
        <div class="nav-bar border-top border-bottom bg-almost-white">
            {include file='partials/mass-actions.tpl'}
            {include file='partials/related-actions.tpl'}
            <span class="btn btn-secondary icon-done-all" data-js="check-all">Zaznacz wszystkie</span>
        </div>
        <input name="path" type="hidden" value="{$sPath}">

        <div class="list-group">
            {foreach from=$list item=item key=ik}
            <div class="list-group-item{if isset($item.unread)} list-group-item-secondary unread{/if}">
            {if !$item.lock}
                <input id="item-{$ik}" name="ids[]" type="checkbox" value="{$item.hash|default:'null'}" class="list-checkbox mass-checkbox">
            {/if}
                <label for="item-{$ik}" class="list-label">
                    <div class="list-header">
                        <time class="gray">{$item.date|default:'unknown'}</time>
                        {if $item.lock}
                        <a href="{$base}/{$ctrl}/{$sPath}/unlock/{$item.hash|default:'null'}" class="icon-lock black" title="Odblokuj" data-js="unlock"></a>
                        {else}
                        <a href="{$base}/{$ctrl}/{$sPath}/lock/{$item.hash|default:'null'}" class="icon-lock gray" title="Zablokuj" data-js="lock"></a>
                        {/if}
                        <!-- <span>Nie możesz zobaczyć tego newsa, bo ktoś już pracuje nad tym tematem.</span> -->
                        <a href="{$item.link|default:'unknown'}" class="dark mobile-single-line">{$item.title|default:'unknown'}</a>
                    </div>
                    {if $item.desc}<p class="mb-1">{$item.desc}</p>{/if}
                    {* <label for="item-{$ik}" class="list-label">{$item.desc|default:'...'} *}
                        <small class="text-muted">
                        {if !$item.lock}
                            <a href="{$base}/{$ctrl}/{$sPath}/mark/{$item.hash|default:'null'}" data-js="mark">Oznacz jako przeczytany</a>
                        {/if}
                        <a href="{$base}/{$ctrl}/{$sPath}/repost/{$item.hash|default:'null'}">Opublikuj</a>
                        </small>
                </label>
                    
                {* </div> *}
            </div>
            {/foreach}
        </div>
        
        <div class="nav-bar border-bottom bg-almost-white">
            {include file='partials/mass-actions.tpl'}
        </div>
    </form>
    {*include file='partials/paginator.tpl'*}
</section>