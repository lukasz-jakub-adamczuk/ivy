<section class="_col card">
    <div class="card-body">
        {include file='controls/authors.tpl'}
    </div>
    {include file='controls/section-buttons.tpl' publish=true}
</section>

<section class="_col card">
    <div class="card-body">
        {include file='controls/creation-date.tpl'}
        {include file='controls/modification-date.tpl'}
    </div>
</section>
<section class="_col card">
    <div class="card-body">
        {*<div class="form-label">
            <label>Opcje wyświetlania</label>
        </div>*}
        <div class="form-group">
            {include file='controls/comments.tpl'}
            {include file='controls/visible.tpl'}
            {include file='controls/verified.tpl'}
        </div>
    </div>
</section>
{include file='controls/option-buttons.tpl'}
<section id="news-images-div" class="col card">
    {include file='controls/images.tpl' label='Galeria' type='news'}
</section>
<section class="col card">
    {include file='controls/changelogs.tpl' visible=false}
</section>