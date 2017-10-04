<section class="col">
    <div class="row">
        {include file='controls/authors.tpl'}
    </div>
</section>
{include file='controls/section-buttons.tpl' publish=true}
<section class="col sticky">
    <div class="row">
        {include file='controls/creation-date.tpl'}
        {include file='controls/modification-date.tpl'}
    </div>
</section>
<section class="col">
    <div class="row">
        <div class="form-label">
            <label>Opcje wyświetlania</label>
        </div>
        <div class="form-component">
            {include file='controls/comments.tpl'}
            {include file='controls/visible.tpl'}
            {include file='controls/verified.tpl'}
        </div>
    </div>
</section>
{include file='controls/option-buttons.tpl'}
<section id="news-images-div" class="col">
    {include file='controls/images.tpl' label='Galeria' type='news'}
</section>
<section class="col">
    {include file='controls/changelogs.tpl' visible=false}
</section>