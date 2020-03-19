<div class="test_values">
    +++ For Testing +++<br/>
    Login: tester<br/>
    Password: test
</div>
<form id="form_login" method="POST">
    <input type="text" name="login" placeholder="Login" required/><br/>
    <input type="password" name="pass" placeholder="Password" required/><br/>
    <input type="submit" class="btn" value="Sing In"/>
</form>
<a href="#" id="btn_to_reg">Registration</a>
<div class="msg"></div>
<script>
    $().ready(function(){
        $('#btn_to_reg').click(function(){
            divShow('#div_reg');
            return false;
        });
        
        $('#form_login').submit(function(){
            ajaxAction('login', '/login', this);
            return false;
        }); 
    });
</script>