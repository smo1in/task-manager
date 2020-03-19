<script src="js/handlers.js"></script>
<script src="js/constructors.js"></script>

<div id="header">
    <h3>Hi, <span class="user_login"></span>!!!</h3>
    <a href="#" id="btn_logout" class="btn">Quit</a>
</div>

<div id="tmp" class="project" style="display: none" data-proj_id="">
    <!---------------------------------------------------------------------------------------->
    <!---------------------------------------------------------------------------------------->
    <!---------------------------------------------------------------------------------------->
    <div class="proj_caption">
        <div class="proj_ico"><i class="material-icons dp48">date_range</i></div>
        <div class="proj_panels">
    <!---------------------------------------------------------------------------------------->
            <div class="proj_index">
                <div class="proj_btns" style="display: none">
                    <div class="btn_proj_edit" title="Edit"><i class="material-icons dp48">edit</i></div>
                    <div class="btn_proj_del" title="Delete"><i class="material-icons dp48">delete</i></div>
                </div>
                <div class="proj_text">
                    <div class="proj_name">New TODO list</div>
                </div>
            </div>
    <!---------------------------------------------------------------------------------------->
            <div class="proj_edit"  style="display: none">
                <div class="proj_btns">
                    <div class="btn_ok" title="Ok"><i class="fa fa-check fa-lg"></i></div>
                    <div class="btn_cancel" title="Cancel"><i class="fa fa-close fa-lg"></i></div>
                </div>
                <div class="proj_text">
                    <form class="proj_edit">
                        <input type="text" name="name" value=""/>
                        <input type="hidden" name="id" value=""/>
                    </form>
                </div>
            </div>
    <!---------------------------------------------------------------------------------------->
            <div class="proj_del" style="display: none">
                 <div class="proj_btns">
                    <div class="btn_ok" title="Ok"><i class="fa fa-check fa-lg"></i></div>
                    <div class="btn_cancel" title="Cancel"><i class="fa fa-close fa-lg"></i></div>
                </div>
                <div class="proj_text">
                    <span class="delete_question text-error"><strong>Delete? </strong></span>
                    <span class="proj_name">New TODO list</span>
                    <form class="proj_del">
                        <input type="hidden" name="id" value=""/>
                    </form>
                </div>
            </div>
    <!---------------------------------------------------------------------------------------->
        </div>
    </div>
    <!---------------------------------------------------------------------------------------->
    <!---------------------------------------------------------------------------------------->
    <!---------------------------------------------------------------------------------------->
    <div class="task_create">
        <form class="task_create" method="POST">
            <div class="create_ico btn_cteate_task"><i class="fa fa-plus fa-lg"></i></div>
            <div class="input-append">
                <input class="span2" type="text" name="name" placeholder="Start typing here to cteate a task..."/>
                <button class="btn" type="submit">Add Task</button>
            </div>
            <input type="hidden" name="proj_id" value=""/>
        </form>
    </div>
    <!---------------------------------------------------------------------------------------->
    <!---------------------------------------------------------------------------------------->
    <!---------------------------------------------------------------------------------------->
    <div class="tasks_list">
        <form class="tasks" method="POST" style="display: none">
            <input type="hidden" name="proj_id" value=""/>
        </form>
        <div class="task" data-task_id="" style="display: none">
    <!---------------------------------------------------------------------------------------->
            <div class="task_index">
                <div class="task_btns" style="display: none">
                    <div class="btns_priority">
                        <div class="btn_prior_up" title="Up priopity"><i class="fa fa-sort-up"></i></div>
                        <div class="btn_prior_down" title="Down priority"><i class="fa fa-sort-down"></i></div>
                        <form class="task_prior_up" method="POST" style="display: none">
                            <input type="hidden" name="id_1" value=""/>
                            <input type="hidden" name="id_2" value=""/>
                        </form>
                        <form class="task_prior_down" method="POST" style="display: none">
                            <input type="hidden" name="id_1" value=""/>
                            <input type="hidden" name="id_2" value=""/>
                        </form>
                    </div>
                    <div class="btn_task_edit" title="Edit"><i class="fa fa-pencil"></i></div>
                    <div class="btn_task_del" title="Delete"><i class="fa fa-trash-o"></i></div>
                </div>
                <div class="task_deadline_value muted">
                    <span>deadline</span>
                    <input type="text" readonly/>
                </div>
                <div class="task_status">
                    <form class="task_status" method="POST">
                        <input type="checkbox" name="status" value="1" title="Status"/>
                        <input type="hidden" name="id" value=""/>
                    </form>
                </div>
                <div class="task_deadline">
                    <i class="fa fa-clock-o fa-lg" title="Deadline"></i>
                    <div class="popover_content" style="display: none">
                        <form class="task_deadline" method="POST">
                            <input type="text" class="deadline" name="deadline" placeholder="no deadline"/>
                            <input type="hidden" name="id" value=""/>
                        </form>
                    </div>
                </div>
                <div class="task_text">
                    <div class="task_name muted">New Task</div>
                </div>
            </div>
    <!---------------------------------------------------------------------------------------->
            <div class="task_edit" style="display: none">
                <div class="task_btns">
                    <div class="btn_ok" title="Ok"><i class="fa fa-check"></i></div>
                    <div class="btn_cancel" title="Cancel"><i class="fa fa-close"></i></div>
                </div>
                <div class="task_status"></div>
                <div class="task_deadline"></div>
                <div class="task_text">
                    <form class="task_edit">
                        <input type="text" name="name" value=""/>
                        <input type="hidden" name="id" value=""/>
                    </form>
                </div>
            </div>
    <!---------------------------------------------------------------------------------------->
            <div class="task_del" style="display: none">
                <div class="task_btns">
                    <div class="btn_ok" title="Ok"><i class="fa fa-check"></i></div>
                    <div class="btn_cancel" title="Cancel"><i class="fa fa-close"></i></div>
                </div>
                <div class="task_status"></div>
                <div class="task_deadline"></div>
                <div class="task_text">
                    <span class="delete_question text-error">Delete? </span>
                    <span class="task_name muted">New Task</span>
                    <form class="task_del" style="display: none">
                        <input type="hidden" name="id" value=""/>
                    </form>
                </div>
            </div>
    <!---------------------------------------------------------------------------------------->
        </div>
    </div>
    <!---------------------------------------------------------------------------------------->
    <!---------------------------------------------------------------------------------------->
    <!---------------------------------------------------------------------------------------->
</div>

<div id="projects"></div>

<form class="proj_create" method="POST">
    <input type="hidden" name="name" value="New TODO List"/>
    <button type="submit" class="btn btn-primary">
        <i class="fa fa-plus fa-2x"></i> 
        <span>Add TODO List</span>
    </button>
</form>