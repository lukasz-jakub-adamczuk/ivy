<script>
    var conf = {ldelim}
        ctrl: '{$ctrl|default:"home"}',
        act: '{$act}',
        func: 'run{$ctrl|replace:"-":" "|capitalize|replace:" ":""}{$act|replace:"-":" "|capitalize|replace:" ":""}'
    {rdelim};
    {if isset($user)}conf.user = {ldelim}
        id: '{$user.id|default:0}',
        name: '{$user.name}',
        slug: '{$user.slug}'
    {rdelim};{/if}
    
    var base = '{$smarty.const.BASE_URL}',
        site = '{$smarty.const.SITE_URL}';
    
    var isis = isis || {ldelim}{rdelim};
    
    isis.vars = {ldelim}{rdelim};
    
    var pressed;
    
    </script>