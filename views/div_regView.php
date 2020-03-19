<form id="form_reg" method="POST">
    <input type="text" name="login" placeholder="Login" required/><br/>
    <input type="email" name="email" placeholder="E-mail" required/><br/>
    <input type="password" name="pass1" placeholder="Password" required/><br/>
    <input type="password" name="pass2" placeholder="Password again" required/><br/>
    <input type="submit" class="btn" value="Registration"/>
</form>
<a href="#" id="btn_to_login">Back to sing in</a>
<div class="msg"></div>
<script>
    $().ready(function(){
        $('#btn_to_login').click(function(){
            divShow('#div_login');
            return false;
        });
        
        $('#form_reg').submit(function(){
            ajaxAction('registration', '/reg', this);
            return false;
        }); 
        
    });
</script>