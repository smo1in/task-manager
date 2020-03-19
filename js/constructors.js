//-------------------------------------------------------------------------------
//---------- PROJECT CONSTRUCTOR ---------------------------------------------------
//-------------------------------------------------------------------------------
function Project(id, name, proj_arr){
    this.id = id;
    this.name = name;
    this.projects = proj_arr;
    this.tasks = [];
    this.div = {};
    
    this.init = function(){
        var curent = this;
        this.div = $('#tmp').clone();
        this.div.removeAttr('id').appendTo('#projects');
        this.div.css({display: 'block'});
        this.div.attr('data-proj_id', this.id);
        
        $(".btn_proj_edit", this.div.get(0)).click(function(){
            $("div.proj_index", curent.div.get(0)).css({display: 'none'});
            $("div.proj_edit", curent.div.get(0)).css({display: 'block'});
        });
        $(".btn_proj_del", this.div.get(0)).click(function(){
            $("div.proj_index", curent.div.get(0)).css({display: 'none'});
            $("div.proj_del", curent.div.get(0)).css({display: 'block'});
        });
        $("form.proj_del", curent.div.get(0)).submit(function(){
            ajaxAction('projectDelete', '/projects/delete', this);
            return false;
        });
        $("form.proj_edit", curent.div.get(0)).submit(function(){
            ajaxAction('projectEdit', '/projects/update', this);
            return false;
        });
        $("div.proj_del .btn_ok", this.div.get(0)).click(function(){
            $("form.proj_del", curent.div.get(0)).submit();
        });
        $("div.proj_edit .btn_ok", this.div.get(0)).click(function(){
            $("form.proj_edit", curent.div.get(0)).submit();
        });
        $("div.proj_del .btn_cancel", this.div.get(0)).click(function(){
            $("div.proj_index", curent.div.get(0)).css({display: 'block'});
            $("div.proj_del", curent.div.get(0)).css({display: 'none'});
        });
        $("div.proj_edit .btn_cancel", this.div.get(0)).click(function(){
            $("div.proj_index", curent.div.get(0)).css({display: 'block'});
            $("div.proj_edit", curent.div.get(0)).css({display: 'none'});
            $("form.proj_edit [name='name']", curent.div.get(0)).val(curent.name);
        });
        
        $("form.task_create", this.div.get(0)).submit(function(){
            ajaxAction('taskCreate', '/tasks/create', this);
            $("[name='name']", this).val('');
            return false;
        });
        $('.proj_caption', this.div.get(0)).hover(
            function(){
                $('.proj_btns', $('.proj_index', this).get(0)).css('display', 'block');
            }, 
            function(){
                $('.proj_btns', $('.proj_index', this).get(0)).css('display', 'none');
        });
    };
    
    this.render = function(){
        $('.proj_name', this.div.get(0)).html(this.name);
        $("form.proj_edit [name='name']", this.div.get(0)).attr('value',this.name);
        $("form.proj_edit [name='id']", this.div.get(0)).val(this.id);
        $("form.proj_del [name='id']", this.div.get(0)).val(this.id);
        $("form.tasks [name='proj_id']", this.div.get(0)).val(this.id);
        $("form.task_create [name='proj_id']", this.div.get(0)).val(this.id);
    };
    
    this.getTasks = function(){
        $("form.tasks", this.div.get(0)).submit(function(){
            ajaxAction('showTasks', '/tasks', this);
            return false;
        });
        $("form.tasks", this.div.get(0)).submit();
    };
}

//-------------------------------------------------------------------------------
//---------- TASK CONSTRUCTOR----------------------------------------------------
//-------------------------------------------------------------------------------
function Task(id, name, status, priority, deadline, project){
    this.id = id;
    this.name = name;
    this.status = status;
    this.priority = priority;
    this.deadline = deadline;
    this.project = project;
    this.div = {};
    this.color = null;
    
    this.init = function(){
        var curent = this;
        this.div = $('#tmp .task').clone();
        $('.tasks_list', this.project.div.get(0)).append(this.div);
        this.div.css({display: 'block'});
        this.div.attr('data-task_id', this.id);
        
        $(".deadline", this.div.get(0)).datepicker({
            dateFormat: "yy-mm-dd",
            altField: "[data-task_id='"+this.id+"'] .task_deadline_value input",
            altFormat: "yy-mm-dd",
            minDate: 0
        });
        
        $("form.task_edit", this.div.get(0)).submit(function(){
            ajaxAction('taskEdit', '/tasks/update', this);
            return false;
        });
        $("form.task_del", this.div.get(0)).submit(function(){
            ajaxAction('taskDelete', '/tasks/delete', this);
            return false;
        });
        $("form.task_prior_up", this.div.get(0)).submit(function(){
            var index = getIndexById(curent.id, curent.project.tasks);
            try{
                $("[name='id_2']", this).val(curent.project.tasks[index-1].id);
                ajaxAction('taskUpPriority', '/tasks/priority', this);
            }catch(e){}
            return false;
        });
        $("form.task_prior_down", this.div.get(0)).submit(function(){
            var index = getIndexById(curent.id, curent.project.tasks);
            try{
                $("[name='id_2']", this).val(curent.project.tasks[index+1].id);
                ajaxAction('taskDownPriority', '/tasks/priority', this);
            }catch(e){}
            return false;
        });
        $("form.task_status", this.div.get(0)).submit(function(){
            ajaxAction('taskStatus', '/tasks/status', this);
            return false;
        });
        $("form.task_deadline", this.div.get(0)).submit(function(){
            ajaxAction('taskDeadline', '/tasks/deadline', this);
            return false;
        });
        
        
        $(".btn_task_edit", this.div.get(0)).click(function(){
            $("div.task_index", curent.div.get(0)).css({display: 'none'});
            $("div.task_edit", curent.div.get(0)).css({display: 'block'});
        });
        $(".btn_task_del", this.div.get(0)).click(function(){
            $("div.task_index", curent.div.get(0)).css({display: 'none'});
            $("div.task_del", curent.div.get(0)).css({display: 'block'});
        });
        $("div.task_del .btn_ok", this.div.get(0)).click(function(){
            $("form.task_del", curent.div.get(0)).submit();
        });
        $("div.task_edit .btn_ok", this.div.get(0)).click(function(){
            $("form.task_edit", curent.div.get(0)).submit();
        });
        $("div.task_del .btn_cancel", this.div.get(0)).click(function(){
            $("div.task_index", curent.div.get(0)).css({display: 'block'});
            $("div.task_del", curent.div.get(0)).css({display: 'none'});
        });
        $("div.task_edit .btn_cancel", this.div.get(0)).click(function(){
            $("div.task_index", curent.div.get(0)).css({display: 'block'});
            $("div.task_edit", curent.div.get(0)).css({display: 'none'});
            $("form.task_edit [name='name']", curent.div.get(0)).val(curent.name);
        });
        $(".btn_prior_up", this.div.get(0)).click(function(){
            $("form.task_prior_up", curent.div.get(0)).submit();
        });
        $(".btn_prior_down", this.div.get(0)).click(function(){
            $("form.task_prior_down", curent.div.get(0)).submit();
        });
        $("form.task_status", this.div.get(0)).change(function(){
            $(this).submit();
        });
        $("form.task_deadline", this.div.get(0)).change(function(){
            $(this).submit();
        });
        
        this.div.hover(
            function(){
                $(this).css({background: '#FCFED5'});
            },
            function(){
                $(this).css({background: curent.color});
        });
        $('.task_index', this.div.get(0)).hover(
            function(){
                $('.task_btns', this).css('display', 'block');
                $('.task_deadline_value', this).css('display', 'none');
            }, 
            function(){
                $('.task_btns', this).css('display', 'none');
                $('.task_deadline_value', this).css('display', 'block');
        });
        
        $("div.task_deadline i", this.div.get(0)).click(function(){
            if($(".popover_content", curent.div.get(0)).css('display') === 'none'){
                $(".popover_content", curent.div.get(0)).css({display: 'block'});
                $("form.task_deadline input[name='deadline']", curent.div.get(0)).focus();
            }else{
                $(".popover_content", curent.div.get(0)).css({display: 'none'});
            }
        });
        $("form.task_deadline input[name='deadline']", curent.div.get(0)).blur(function(){
            $(".popover_content", curent.div.get(0)).css({display: 'none'});
        });
        
    }
    
    this.render = function(){
        var curent = this;
        
        if(!this.checkDeadline()){
            this.color = '#FFDAB9';
        }else{
            this.color = 'white';
        }
        
        this.div.css({background: this.color});
        
        $('.task_name', this.div.get(0)).html(this.name);
        if(+this.status){
            $("form.task_status [name='status']", this.div.get(0)).attr('checked','checked');
        }
        $("[name='id']", this.div.get(0)).val(this.id);
        $("form.task_edit [name='name']", this.div.get(0)).attr('value',this.name);
        
        $("form.task_prior_up [name='id_1']", this.div.get(0)).val(this.id);
        $("form.task_prior_down [name='id_1']", this.div.get(0)).val(this.id);
        
        $("form.task_deadline [name='deadline']", this.div.get(0)).val(this.deadline);
        $("div.task_deadline_value input", this.div.get(0)).val(this.deadline);
        
        if(!$("div.task_deadline_value input", this.div.get(0)).val()){
            $("div.task_deadline_value span", this.div.get(0)).css({display:'none'});
        }else{
            $("div.task_deadline_value span", this.div.get(0)).css({display:'inline'});
        }
        
        $("[data-task_id='"+this.id+"']>div>div")
                .css({'height':this.div.css('height')
        });
    };
    
    this.checkDeadline = function(){
        if(this.deadline){
            var deadline = new Date(this.deadline).getTime();
            var now = new Date().getTime();
            if(deadline+(1000*3600*24) < now){
                return false;
            }
        }
        return true;
    }
}