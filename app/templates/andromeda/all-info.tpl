{include file='partials/info-header.tpl' header=$header|default:'Szczegóły'}
<section>
    <form method="post" action="{$base}/{$ctrl}/{$sFormMode}" class="table-form">
        <div class="row">
            <div class="form-content-main">
                <input name="id" type="hidden" value="{$aFields[$entityPrimaryKey]|default:0}" />
                {include file=$sFormMainPartTemplate}
            </div>
            <div class="form-content-sub">
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