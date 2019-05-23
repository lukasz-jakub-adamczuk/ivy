{include file='partials/index-header.tpl' header=$header|default:$sections.$ctrl.name}
{include file='partials/sections.tpl'}
<section class="container_">
    {include file='partials/filters.tpl'}
    
    {include file='partials/pagination.tpl'}
    <form method="post" action="{$base}/{$ctrl}">
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with buttons">
            {include file='partials/mass-actions.tpl'}
            {include file='partials/related-actions.tpl'}
        </div>

        {$sTable}
        
        {*<div class="nav-bar border-bottom bg-almost-white">*}
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with buttons">
            {include file='partials/mass-actions.tpl'}
        </div>
    </form>
    {include file='partials/pagination.tpl'}
</section>
