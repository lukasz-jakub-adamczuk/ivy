{if isset($promote) or isset($delete)}
<section class="col sticky text-right relative">
    {include file='buttons/delete-n-undelete.tpl'}
    {include file='buttons/promote.tpl'}
</section>{/if}