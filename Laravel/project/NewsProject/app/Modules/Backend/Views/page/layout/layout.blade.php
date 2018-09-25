<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - @yield('title')</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/Laravel/project/admin/assets/css/normalize.css">
    <link rel="stylesheet" href="/Laravel/project/admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Laravel/project/admin/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Laravel/project/admin/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/Laravel/project/admin/assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="/Laravel/project/admin/assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="/Laravel/project/admin/assets/scss/style.css">
    <link href="/Laravel/project/admin/assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <p style="font-weight: 24px; color: darkgoldenrod; margin-top: 30px">
                    PAGE MANAGEMENT
                </p>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="#"> <i class="menu-icon fa fa-home"></i>Homepage</a>
                    </li>
                    <h3 class="menu-title">NEWS MANAGEMENT</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Category</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-plus-square"></i><a href="/Laravel/project/admin/addcategory">Add</a></li>
                            <li><i class="menu-icon fa fa-pencil-square-o"></i><a href="/Laravel/project/admin/category">Edit/Delete</a></li>
                            <li><i class="menu-icon fa fa-exchange"></i><a href="/Laravel/project/admin/relation">Relation</a></li>
                        </ul>
                    </li>
                   
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder"></i>News</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-plus-square"></i><a href="/Laravel/project/admin/addnews">Add</a></li>
                            <li><i class="menu-icon fa fa-pencil-square-o"></i><a href="/Laravel/project/admin/news">Edit/Delete</a></li>
                        </ul>
                    </li>

                    <h3 class="menu-title">USER MANAGEMENT</h3><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>User Info</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-info"></i><a href="#">Profile</a></li>
                            <li><i class="menu-icon fa fa-book"></i><a href="#">History</a></li>
                        </ul>
                    </li>
                   
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-check-square"></i>Permission</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-check-square-o"></i><a href="#">Role</a></li>
                            <li><i class="menu-icon fa fa-gear"></i><a href="#">Edit permission</a></li>
                            <li><i class="menu-icon fa fa-ban"></i><a href="#">Block</a></li>
                        </ul>
                    </li>
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">


        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-5" style="float: right">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>
                       
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                                <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications</a>

                                <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                                <a class="nav-link" href="#"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        </header>
        <!-- /header -->
        <!-- Header-->

        @yield('content')

         <!-- .content -->
    </div>
    <script src="/Laravel/project/admin/assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="/Laravel/project/admin/assets/js/plugins.js"></script>
    <script src="/Laravel/project/admin/assets/js/main.js"></script>
    


</body>
</html>
