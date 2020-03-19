<?php

include_once (ROOT.'/models/UserModel.php');


class UserController {
    
    
    public function actionLogin(){
        $login = '';
        $pass_entered = '';
        $answer = array(
            'ok' => 0,
            'msg' => array(),
            'data' => array()
        );
        
        if(     isset($_POST['login']) &&
                isset($_POST['pass'])
            ){
            $login = htmlentities($_POST['login'], ENT_QUOTES);
            $pass_entered = htmlentities($_POST['pass']);
        }
        
        if($login === ''){
            $answer['msg'][] = 'was not entered Login';
        }
        if($pass_entered === ''){
            $answer['msg'][] = 'was not entered Password';
        }
        
        if(!$answer['msg']){
            $pass_gotten = UserModel::getPasswordByLogin($login);
            if(password_verify($pass_entered, $pass_gotten)){
                $_SESSION['user'] = UserModel::getIdByLogin($login);
                $answer['data']['login'] = $login;
                $answer['ok'] = 1;
                $answer['msg'][] = "you singin as $login";
                $answer['msg'][] = "your id is {$_SESSION['user']}";
            }else{
                $answer['msg'][] = 'entered an incorrect Login or Password';
            }
        }
        echo (json_encode($answer));
        
        return true;
    }
    
    public function actionGetLogin(){
        $user_id = UserModel::checkLogged();
        if(!$user_id){
            echo 'false';
            exit();
        }
        $answer = array(
            'ok' => 0,
            'data' => array()
        );
        $answer['data']['login'] = UserModel::getLoginById($user_id);
        if($answer['data']['login']){
            $answer['ok'] = 1;
        }
        echo (json_encode($answer));
        return TRUE;
    }
    
    
    public function actionLogout(){
        unset($_SESSION['user']);
        echo '1';
        return TRUE;
    }

    
    public function actionRegistration(){
        $login = '';
        $email = '';
        $pass1_hash = '';
        $pass2 = '';
        $answer = array(
            'ok' => 0,
            'msg' => array()
        );
        
        if(     isset($_POST['login']) &&
                isset($_POST['email']) &&
                isset($_POST['pass1']) &&
                isset($_POST['pass2'])
            ){
            $login = htmlentities($_POST['login'], ENT_QUOTES);
            $email = $_POST['email'];
            $pass1_hash = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
            $pass2 = $_POST['pass2'];
        }
        
        if($login === ''){
            $answer['msg'][] = 'was not entered Login';
        }
        if($email === ''){
            $answer['msg'][] = 'was not entered E-mail';
        }
        if($pass1_hash === ''){
            $answer['msg'][] = 'was not entered Password';
        }
        if($pass2 === ''){
            $answer['msg'][] = 'was not entered Password again';
        }
        if(!$answer['msg']){
            if(UserModel::checkLogin($login)){
                $answer['msg'][] = 'this Login already registered';
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $answer['msg'][] = 'entered a wrong E-mail';
            }
            if(UserModel::checkEmail($email)){
                $answer['msg'][] = 'this E-mail already registered';
            }
            if(!password_verify($pass2, $pass1_hash)){
                $answer['msg'][] = 'Passwords are not equal';
            }
        }
        
        if(!$answer['msg']){
            $result = UserModel::registration($login, $email, $pass1_hash);
            if($result){
                $answer['ok'] = 1;
                $answer['msg'][] = 'registration completed successfully';
            }else{
                $answer['msg'][] = 'registration error';
                $answer['msg'][] = 'please, try again in a few minutes';
            }
        }
        
        echo (json_encode($answer));
        
        return true;
    }
    
}
