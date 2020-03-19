<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Task Manager</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/Font-Awesome-v4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="js/jquery-ui-1.11.4.custom/jquery-ui.min.css" />
    <link rel="stylesheet" href="/css/main-styles.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <script src="/js/jquery-2.1.4.min.js"></script>
    <script src="js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <script src="/js/ajax.js"></script>
    <script src="/js/main-functions.js"></script>
    <script src="/js/actions.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="page-wrapper">


        <div id="main" class="container">
            <div id="div_login" style="display: none"></div>
            <div id="div_reg" style="display: none"></div>
            <div id="div_projects" style="display: none"></div>
        </div>


        <script>
            $().ready(function() {
                $.post("/start", {}, initApp);
            });
        </script>
        <script src="/js/bootstrap.min.js"></script>
</body>

</html>