//Global variable
var projects = [];

$().ready(function(){
    
    ajaxAction('insertLogin', '/getlogin');
    ajaxAction('showProjects', '/projects');
    
    $('#btn_logout').click(function(){
        ajaxAction('logout', '/logout');
        return false;
    });
    
    $('.proj_create').submit(function(){
        ajaxAction('projectCreate', '/projects/create', this);
        return false;
    });
    
    
});