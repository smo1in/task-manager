//-------------------------------------------------------------------
//---------- AJAX FUNCTIONS -----------------------------------------
//-------------------------------------------------------------------

/**
 * Loads html-template by div id
 * And lounchs show this div
 * 
 * @param {string} div_id
 * @returns {undefined}
 */
function divLoad(div_id){
    $(div_id).load('/template/'+div_id.replace('#',''), {}, function(){
        divShow(div_id);
    });
}

/**
 * Sends query to back-end
 * Gets data from back-end
 * Launchs action
 * 
 * @param {string} action_name (action name in file /js/actions.js)
 * @param {string} path (URL for backend routing (in file /config/routes.php))
 * @param {object} obj (form object)
 * @returns {undefined}
 */
function ajaxAction(action_name, path, obj){
    var params = {};
    if(obj){
        var arr = $(obj).serializeArray();
        for(var i=0; i<arr.length; i++){
            params[arr[i].name] = arr[i].value;
        }
    }
    $.post(path, params, 
            function(data){
                var action = 'action'+ucfirst(action_name);
                new Function(action+'(\''+data+'\')')();
            }); 
}