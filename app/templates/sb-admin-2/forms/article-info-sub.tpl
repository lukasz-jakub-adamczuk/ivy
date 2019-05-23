<section class="col sticky">
    <div class="row">
        {include file='controls/creation-date.tpl'}
        {include file='controls/modification-date.tpl'}
    </div>
    {*include file='controls/previewer.tpl'*}
</section>
{include file='controls/section-buttons.tpl' publish=true}
<section class="col">
    <div class="row">
        {include file='controls/authors.tpl'}
        {include file='controls/categories.tpl' cpk='id_article_category'}
        {include file='controls/templates.tpl' tpk='id_article_template'}
    </div>
</section>
<section class="col">
    <div class="row">
        <div class="form-label">
            Opcje wyświetlania
        </div>
        <div class="form-component">
            {include file='controls/visible.tpl'}
            {include file='controls/verified.tpl'}
            {include file='controls/deleted.tpl'}
        </div>
    </div>
</section>
{include file='controls/option-buttons.tpl' promote=true}
decide to you want to see logo in stories
<section id="logo-image-fragment-div" class="col">
    {include file='controls/fragment-image.tpl' type='logo'}
</section>
<section id="cover-image-fragment-div" class="col">
    {include file='controls/fragment-image.tpl' type='cover'}
</section>
<section class="col">
    {include file='controls/changelogs.tpl' visible=false}
</section>
