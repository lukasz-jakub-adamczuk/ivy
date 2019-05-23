{include file='partials/info-header.tpl' header=$header|default:'Szczegóły'}
<section>
    <form method="post" action="{$base}/{$ctrl}/{$sFormMode}" class="form">
        <div class="form-row">
            <div class="form-content-main col-lg-8">
                <input name="id" type="hidden" value="{$aFields[$entityPrimaryKey]|default:0}" />
                {include file=$sFormMainPartTemplate}
            </div>
            <div class="form-content-sub col-lg-4">
                {include file=$sFormSubPartTemplate}
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-buttons text-right">
                {include file='buttons/back.tpl'}
                {include file='buttons/add-n-save.tpl'}
            </div>
        </div>
    </form>
</section>