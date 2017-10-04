{if isset($publish) or isset($aFields.visible)}
<section class="col sticky relative text-right">
    {include file='buttons/publish.tpl'}
    {include file='buttons/preview.tpl'}
    {include file='buttons/add-n-save.tpl'}
</section>{/if}