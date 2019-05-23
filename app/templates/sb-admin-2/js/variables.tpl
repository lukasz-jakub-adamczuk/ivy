<script>
var conf = {ldelim}
    ctrl: '{$ctrl|default:"home"}',
    act: '{$act}',
    func: 'run{$ctrl|replace:"-":" "|capitalize|replace:" ":""}{$act|replace:"-":" "|capitalize|replace:" ":""}'
{rdelim};
{if $usr::set()}conf.user = {ldelim}
    id: '{$usr::getId()|default:0}',
    name: '{$usr::getName()}',
    slug: '{$usr::getSlug()}'
{rdelim};{/if}
var base = '{$smarty.const.BASE_URL}',
    site = '{$smarty.const.SITE_URL}';

var isis = isis || {ldelim}{rdelim};

isis.vars = {ldelim}{rdelim};

var pressed;
</script>