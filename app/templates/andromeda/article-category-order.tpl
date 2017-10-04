{include file='partials/info-header.tpl' header=$header}
<section class="container">
    <form method="post" action="{$base}/{$ctrl}/update-order">
        <input name="ctrl" type="hidden" value="{$sCtrl|default:$ctrl}">
        <ul id="sortable-categories" class="sortable-list">
            {include 'partials/list-items.tpl' list=$aElements}
        </ul>
        this form could be changed...
        <div class="buttons">
            {include file='controls/buttons.tpl'}
        </div>
    </form>
</section>