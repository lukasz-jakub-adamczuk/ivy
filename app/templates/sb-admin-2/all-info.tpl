{include file='partials/info-header.tpl' header=$header|default:'Szczegóły'}
<section>
    <form id="info-form" method="post" action="{$base}/{$ctrl}/{$sFormMode}" class="form">
        <div class="form-row">
            <div class="form-content-main col-lg-8">
                <input id="form-id" name="id" type="hidden" value="{$aFields[$entityPrimaryKey]|default:0}" />
                <input id="form-ctrl" name="ctrl" type="hidden" value="{$ctrl}" />
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