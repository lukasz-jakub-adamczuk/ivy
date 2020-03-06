{config_load file='variables.conf' section='controllers'}
{if $usr::set()}
<!DOCTYPE html>
<html>
{include file='head.tpl'}
<body id="page-top" class="sidebar-toggled">
    {if $smarty.const.DEBUG_MODE}
        {include file='debug.tpl'}
    {/if}
    <div id="wrapper">
        {include file='sidebar.tpl'}
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                {include file='nav.tpl'}
                <div class="container-fluid">
                    {include file='messages.tpl'}
                    {include file="$content.tpl"}
                </div>
            </div>
            {*include file='footer.tpl'*}
        </div>
    </div>
    {include file='dialog.tpl'}
    {include file='scripts.tpl'}
</body>
</html>
{else}
<!DOCTYPE html>
<html lang="en">
{include file='head.tpl'}
<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Panel użytkownika</h1>
                                    </div>
                                    <form id="auth-form" method="post" action="{$base}/auth/login" class="user">
                                        <div class="form-group">
                                            <input id="auth-user" name="auth[user]" type="text" class="form-control form-control-user" placeholder="Nazwa użytkownika">
                                        </div>
                                        <div class="form-group">
                                            <input id="auth-pass" name="auth[pass]" type="password" class="form-control form-control-user" placeholder="Hasło">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Zapamiętaj mnie</label>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Zaloguj" />
                                        {* <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Zaloguj
                                        </a> *}
                                        {* <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> *}
                                    </form>
                                    {* <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> *}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    {* <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script> *}
</body>
</html>
{/if}