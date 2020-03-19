/**
 * Shows login form or user projects
 * 
 * @param {string} data
 * @returns {undefined}
 */
function initApp(data){
    if(data){
        divShow('#div_projects');
    }else{
        divShow('#div_login');
    }
}

/**
 * Shows div by id
 * If div is empty, then loads html-template
 * 
 * @param {string} div_id
 * @returns {undefined}
 */
function divShow(div_id){
    $(div_id).siblings().andSelf().hide(0);
    if(!$(div_id).html()){
        divLoad(div_id);
    }else{
        $(div_id).show(0);
    }
}

/**
 * Show message
 * 
 * @param {string} selector
 * @param {string} msg (message)
 * @param {integer} time
 * @returns {undefined}
 */
function msgShow(selector, msg, time){
    if(!time){
        time = 3000;
    }
    var msg_html = '';
    for(var i=0; i<msg.length; i++){
        msg_html += msg[i]+'<br/>';
    }
    $(selector).html(msg_html);
    setTimeout(function(){
        $(selector).fadeOut(1000, function(){
            $(selector).html('');
            $(selector).show();
        });
    }, time);
}

/**
 * 
 * @param {json-string} data
 * @returns {Array|Object}
 */
function getData(data){
    if(data === 'false'){
        $('#div_projects').empty();
        divShow('#div_login');
    }
    return JSON.parse(data);
}

/**
 * Returns index of element of array, that have field 'id' as need
 * 
 * @param {integer} id
 * @param {array} arr
 * @returns {integer} (element index)
 */
function getIndexById(id, arr){
    for(var i=0; i<arr.length; i++){
        if(arr[i]['id'] == id){
            return i;
        }
    }
}

/**
 * Returns word with first letter in uppercase
 * 
 * @param {string} string
 * @returns {string}
 */
function ucfirst(string){
    return string[0].toUpperCase() + string.slice(1);
}