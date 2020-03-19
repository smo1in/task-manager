//-----------------------------------------------------------------------
//---- User Actions -----------------------------------------------------
//-----------------------------------------------------------------------
function actionRegistration(data){
    data = JSON.parse(data);
    if(+data['ok']){
        $('#form_reg input').not("[type=submit]").each(function(){
           $(this).val('');
        });
        divShow('#div_login');
        msgShow('#div_login .msg', data['msg']);
    }else{
        $('#form_reg [type=password]').each(function(){
           $(this).val(''); 
        });
        msgShow('#div_reg .msg', data['msg'], 10000);
    }
}

function actionLogin(data){
    data = JSON.parse(data);
    if(+data['ok']){
        $('#form_login input').not("[type=submit]").each(function(){
           $(this).val('');
        });
        divShow('#div_projects');
    }else{
        $('#form_login [type=password]').each(function(){
           $(this).val(''); 
        });
        msgShow('#div_login .msg', data['msg'], 10000);
    }
}

function actionLogout(data){
    data = JSON.parse(data);
    if(+data){
        $('#div_projects').empty();
        divShow('#div_login');
    }
}

/**
 * Insert user login to header
 * 
 * @param {json-string} data
 * @returns {undefined}
 */
function actionInsertLogin(data){
    data = getData(data);
    if(+data['ok']){
        $('.user_login').html(ucfirst(data['data']['login']));
    }
}
//-----------------------------------------------------------------------
//---- Project Actions --------------------------------------------------
//-----------------------------------------------------------------------
function actionShowProjects(data){
    data = getData(data);
    if(+data['ok'] && data['data'].length>0){
        for(var i=0; i<data['data'].length; i++){
            projects[i]=new Project(data['data'][i]['id'], data['data'][i]['name'], projects);
            projects[i].init();
            projects[i].render();
            projects[i].getTasks();
        }
    }
}

function actionProjectDelete(data){
    data = getData(data);
    if(+data['ok']){
        var index = getIndexById(data['data']['id'], projects);
        projects.splice(index,1);
        $("[data-proj_id='"+data['data']['id']+"']").remove();
    }
}

function actionProjectEdit(data){
    data = getData(data);
    if(+data['ok']){
        var index = getIndexById(data['data']['id'], projects);
        projects[index].name = data['data']['name'];
        projects[index].render();
        $("div.proj_index", projects[index].div.get(0)).css({display: 'block'});
        $("div.proj_edit", projects[index].div.get(0)).css({display: 'none'});
    }
}

function actionProjectCreate(data){
    data = getData(data);
    if(+data['ok']){
        var project = new Project(data['data']['id'], data['data']['name'], projects);
        projects.push(project);
        project.init();
        project.render();
        $('.btn_proj_edit', project.div.get(0)).click();
        $('form.proj_edit [name="name"]', project.div.get(0))
                .val('')
                .attr({placeholder: 'TODO list name'})
                .focus();
    }
}
//-----------------------------------------------------------------------
//---- Task Actions -----------------------------------------------------
//-----------------------------------------------------------------------
function actionShowTasks(data){
    data = getData(data);
    if(+data['ok'] && data['data'].length>0){
        var index = getIndexById(data['data'][0]['project_id'], projects);
        for(var i=0; i<data['data'].length; i++){
            var task = data['data'][i];
            projects[index].tasks[i]=new Task(task['id'], task['name'], task['status'], task['priority'], task['deadline'], projects[index]);
            projects[index].tasks[i].init();
            projects[index].tasks[i].render();
        }
    }
}

function actionTaskCreate(data){
    data = getData(data);
    if(+data['ok']){
        var index = getIndexById(data['data']['project_id'], projects);
        var task = new Task(data['data']['id'], data['data']['name'], data['data']['status'],
                            data['data']['priority'], data['data']['deadline'], projects[index]);
        projects[index].tasks.unshift(task);
        task.init();
        task.render();
        task.div.insertBefore(projects[index].tasks[1].div);
    }
}

function actionTaskEdit(data){
    data = getData(data);
    if(+data['ok']){
        var i_p = getIndexById(data['data']['project_id'], projects);
        var i_t = getIndexById(data['data']['id'], projects[i_p].tasks);
        var task = projects[i_p].tasks[i_t];
        task.name = data['data']['name'];
        task.render();
        $("div.task_index", task.div.get(0)).css({display: 'block'});
        $("div.task_edit", task.div.get(0)).css({display: 'none'});
    }
}

function actionTaskDelete(data){
    data = getData(data);
    if(+data['ok']){
        var i_p = getIndexById(data['data']['project_id'], projects);
        var i_t = getIndexById(data['data']['id'], projects[i_p].tasks);
        projects[i_p].tasks.splice(i_t,1);
        $("[data-task_id='"+data['data']['id']+"']").remove();
    }
}

function actionTaskUpPriority(data){
    data = getData(data);
    if(+data['ok']){
        var i_proj = getIndexById(data['data']['task_1']['project_id'], projects);
        var i_task_1 = getIndexById(data['data']['task_1']['id'], projects[i_proj].tasks);
        var i_task_2 = getIndexById(data['data']['task_2']['id'], projects[i_proj].tasks);
        var task_1 = projects[i_proj].tasks[i_task_1];
        var task_2 = projects[i_proj].tasks[i_task_2];
        task_1.priority = data['data']['task_1']['priority'];
        task_2.priority = data['data']['task_2']['priority'];
        task_1.div.after(task_2.div);
        projects[i_proj].tasks[i_task_1] = task_2;
        projects[i_proj].tasks[i_task_2] = task_1;
    }
}

function actionTaskDownPriority(data){
    data = getData(data);
    if(+data['ok']){
        var i_proj = getIndexById(data['data']['task_1']['project_id'], projects);
        var i_task_1 = getIndexById(data['data']['task_1']['id'], projects[i_proj].tasks);
        var i_task_2 = getIndexById(data['data']['task_2']['id'], projects[i_proj].tasks);
        var task_1 = projects[i_proj].tasks[i_task_1];
        var task_2 = projects[i_proj].tasks[i_task_2];
        task_1.priority = data['data']['task_1']['priority'];
        task_2.priority = data['data']['task_2']['priority'];
        task_2.div.after(task_1.div);
        projects[i_proj].tasks[i_task_1] = task_2;
        projects[i_proj].tasks[i_task_2] = task_1;
    }
}

function actionTaskStatus(data){
    data = getData(data);
    if(+data['ok']){
        var i_p = getIndexById(data['data']['project_id'], projects);
        var i_t = getIndexById(data['data']['id'], projects[i_p].tasks);
        projects[i_p].tasks[i_t].status = data['data']['status'];
        projects[i_p].tasks[i_t].render();
    }
}

function actionTaskDeadline(data){
    data = getData(data);
    if(+data['ok']){
        var i_p = getIndexById(data['data']['project_id'], projects);
        var i_t = getIndexById(data['data']['id'], projects[i_p].tasks);
        projects[i_p].tasks[i_t].deadline = data['data']['deadline'];
        projects[i_p].tasks[i_t].render();
    }
}