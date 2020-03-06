<section class="card">
    <div class="card-body">
        {include file='controls/creation-date.tpl'}
        {include file='controls/modification-date.tpl'}
    </div>
    {include file='controls/section-buttons.tpl' publish=true}
    {*include file='controls/previewer.tpl'*}
</section>

<section class="card">
    <div class="card-body">
        {include file='controls/authors.tpl'}
        {include file='controls/categories.tpl' cpk='id_story_category'}
        {* {include file='controls/templates.tpl' tpk='id_article_template'} *}
    </div>
</section>
<section class="card">
    <div class="card-body">
        <div class="form-group">
            {* {include file='controls/comments.tpl'} *}
            {include file='controls/visible.tpl'}
            {include file='controls/verified.tpl'}
            {include file='controls/deleted.tpl'}
        </div>
    </div>
</section>
{include file='controls/option-buttons.tpl' promote=true}
decide to you want to see logo in stories
<section id="logo-image-fragment-div" class="col">
logo
    {include file='controls/fragment-image.tpl' type='logo'}
</section>
<section id="cover-image-fragment-div" class="col">
cover
    {include file='controls/fragment-image.tpl' type='cover'}
</section>
<section class="col">
    {include file='controls/changelogs.tpl' visible=false}
</section>
