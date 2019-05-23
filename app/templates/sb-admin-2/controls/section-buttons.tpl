{if isset($publish) or isset($aFields.visible)}
<section class="_col _sticky _relative _text-right card-footer">
    {include file='buttons/publish.tpl'}
    {include file='buttons/preview.tpl'}
    {include file='buttons/add-n-save.tpl'}
</section>{/if}

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>
