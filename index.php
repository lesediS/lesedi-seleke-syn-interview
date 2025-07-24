<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <link rel="shortcut icon" href="assets/images/favicon.png">

        <title>Synrgise - Innovate Learning</title>


        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/core.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/components.css" rel="stylesheet" type="text/css">
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
        <link href="assets/css/elements.css" rel="stylesheet" type="text/css">
        <link href="assets/css/datepicker.css" rel="stylesheet">

        <script src="assets/js/modernizr.min.js"></script>


    </head>


    <body>

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="index.html" class="logo"><img src="assets/images/synrgise-logo.png"></a>
                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras">

                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li class="dropdown hidden-xs">
                                <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                    <i class="md md-notifications"></i> <span class="badge badge-xs badge-danger">3</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg">
                                    <li class="text-center notifi-title">Notification</li>
                                    <li class="list-group">
                                       <!-- list item-->
                                       <a href="javascript:void(0);" class="list-group-item">
                                          <div class="media">
                                             <div class="pull-left">
                                                <em class="fa fa-user-plus fa-2x text-info"></em>
                                             </div>
                                             <div class="media-body clearfix">
                                                <div class="media-heading">New user registered</div>
                                                <p class="m-0">
                                                   <small>You have 10 unread messages</small>
                                                </p>
                                             </div>
                                          </div>
                                       </a>
                                       <!-- list item-->
                                        <a href="javascript:void(0);" class="list-group-item">
                                          <div class="media">
                                             <div class="pull-left">
                                                <em class="fa fa-diamond fa-2x text-primary"></em>
                                             </div>
                                             <div class="media-body clearfix">
                                                <div class="media-heading">New settings</div>
                                                <p class="m-0">
                                                   <small>There are new settings available</small>
                                                </p>
                                             </div>
                                          </div>
                                        </a>
                                        <!-- list item-->
                                        <a href="javascript:void(0);" class="list-group-item">
                                          <div class="media">
                                             <div class="pull-left">
                                                <em class="fa fa-bell-o fa-2x text-danger"></em>
                                             </div>
                                             <div class="media-body clearfix">
                                                <div class="media-heading">Updates</div>
                                                <p class="m-0">
                                                   <small>There are
                                                      <span class="text-primary">2</span> new updates available</small>
                                                </p>
                                             </div>
                                          </div>
                                        </a>
                                       <!-- last list item -->
                                        <a href="javascript:void(0);" class="list-group-item">
                                          <small>See all notifications</small>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown user-box">
                                <a href="" class="dropdown-toggle waves-effect waves-light profile " data-toggle="dropdown" aria-expanded="true">
                                    <img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle user-img">
                                    <div class="user-status away"><i class="zmdi zmdi-dot-circle"></i></div>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile</a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-settings-power"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>

                </div>
            </div>

            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li class="active"><a href="index.html"><i class="md md-home"></i> <span> Dashboard </span> </a></li>
                        </ul>
                        <!-- End navigation menu  -->
                    </div>
                </div>
            </div>

            <div class="subheader">
                <div class="container">
                    <div class="row m-b-20">
                        <div class="col-md-12">
                            <h1 style="color: #fff;">Tasks</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs">
                                <li class="tab active">
                                    <a id="myTasks" data-toggle="tab" href="#mytasks" >
                                        <span class="visible-xs"><i data-toggle="tooltip" title="My Tasks" class="fa fa-user"></i></span>
                                        <span class="hidden-xs">My Tasks</span>
                                    </a>
                                </li>
                                <li>
                                    <a id="manageTasks" data-toggle="tab" href="#managetasks" style="cursor: pointer;">
                                        <span class="visible-xs"><i data-toggle="tooltip" title="Manage Tasks" class="fa fa-gear"></i></span>
                                        <span class="hidden-xs">Manage Tasks</span>
                                    </a>
                                </li>
                                <li>
                                    <a id="completedTasks" data-toggle="tab" href="#completedtasks" style="cursor: pointer;">
                                        <span class="visible-xs"><i data-toggle="tooltip" title="Completed Tasks" class="fa fa-folder-open-o"></i></span>
                                        <span class="hidden-xs">Completed Tasks</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Navigation Bar-->

        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="tab-content">
                        <div id="mytasks" class="tab-pane fade in active">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-primary waves-effect waves-light">Mark as complete</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>Dec</div>
                                            <div class="checkbox checkbox-primary ">
                                                <input class="todo-done" id="1" type="checkbox">
                                                <label for="1"></label>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3>Task 1</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>Dec</div>
                                            <div class="checkbox checkbox-primary ">
                                                <input class="todo-done" id="2" type="checkbox">
                                                <label for="2"></label>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3>Task 2</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>Dec</div>
                                            <div class="checkbox checkbox-primary ">
                                                <input class="todo-done" id="3" type="checkbox">
                                                <label for="3"></label>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3>Task 3</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>Dec</div>
                                            <div class="checkbox checkbox-primary ">
                                                <input class="todo-done" id="4" type="checkbox">
                                                <label for="4"></label>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3>Task 4</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>Dec</div>
                                            <div class="checkbox checkbox-primary ">
                                                <input class="todo-done" id="5" type="checkbox">
                                                <label for="5"></label>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3>Task 5</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="managetasks" class="tab-pane fade">
                            <div class="row m-b-20 new-button">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-primary waves-effect waves-light new-task-btn"><i class="fa fa-plus"></i> Add New Task</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Created Tasks -->
                            <div class="row created-tasks">
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>Dec</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3>Task 1</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer" style="padding: 0;text-align: right;">
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="button" id="" title="Edit" class="btn btn icon-btn">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </div>
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="button" id="" title="Unpublish" class="btn btn icon-btn">
                                                    <i class="fa fa-power-off"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>Dec</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3>Task 2</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer" style="padding: 0;text-align: right;">
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="button" id="" title="Edit" class="btn btn icon-btn">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </div>
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="button" id="" title="Unpublish" class="btn btn icon-btn">
                                                    <i class="fa fa-power-off"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>Dec</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3>Task 3</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer" style="padding: 0;text-align: right;">
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="button" id="" title="Edit" class="btn btn icon-btn">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </div>
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="button" id="" title="Unpublish" class="btn btn icon-btn">
                                                    <i class="fa fa-power-off"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>Dec</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3>Task 4</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer" style="padding: 0;text-align: right;">
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="button" id="" title="Edit" class="btn btn icon-btn">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </div>
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="button" id="" title="Unpublish" class="btn btn icon-btn">
                                                    <i class="fa fa-power-off"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>Dec</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3>Task 5</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer" style="padding: 0;text-align: right;">
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="button" id="" title="Edit" class="btn btn icon-btn">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </div>
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="button" id="" title="Unpublish" class="btn btn icon-btn">
                                                    <i class="fa fa-power-off"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end Created Tasks -->

                            <!-- New Tasks -->
                            <div class="row new-task_panel" style="display: none;">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><i class="fa fa-plus"></i> New Task</h4>
                                    </div>
                                    <div class="panel-body">
                                        <form role="form">
                                            <div class="form-group">
                                                <label class="control-label">Task Name</label>
                                                <input type="text" class="form-control" value="Some text value...">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Description</label>
                                                <textarea class="form-control" rows="5"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-md-4">Due Date</label>
                                                    <div class="input-group col-md-8">
                                                        <input type="text" class="form-control date-input" placeholder="mm/dd/yyyy" id="datepicker">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="pull-right">
                                                    <button type="submit" class="create-btn btn btn-primary waves-effect waves-light">Create</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- end New Tasks -->
                        </div>

                        <div id="completedtasks" class="tab-pane fade">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <div class="icon-links quick-icon-links">
                                            <button data-toggle="tooltip" type="button" id="block-view" title="Block view" class="btn btn icon-btn">
                                                <i class="block-view fa fa-th-large text-primary"></i>
                                            </button>
                                        </div>
                                        <div class="icon-links quick-icon-links" style="margin-right: 20px;">
                                            <button data-toggle="tooltip" type="button" id="list-view" title="List view" class="btn btn icon-btn">
                                                <i class="list-view fa fa-th-list"></i>
                                            </button>
                                        </div>

                                        <button type="button" class="btn dropdown-toggle btn-primary waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><i class="md md-file-download"></i> Export</button>
                                        <ul class="dropdown-menu" role="menu" style="right: 30px;">
                                            <li><a href="#">PDF</a></li>
                                            <li><a href="#">Excel CSV</a></li>
                                        </ul>
                                        <button type="button" class="btn btn-default waves-effect waves-light"> Delete All</button>

                                    </div>
                                </div>
                            </div>
                            <div class="row completed-blocks">
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>June</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3>Task 0.5</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer" style="padding: 0;text-align: right;">
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="button" id="" title="Delete" class="btn btn icon-btn">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>June</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3>Task </h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer" style="padding: 0;text-align: right;">
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="button" id="" title="Delete" class="btn btn icon-btn">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>June</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3>Task 2.0</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer" style="padding: 0;text-align: right;">
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="button" id="" title="Delete" class="btn btn icon-btn">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="panel" style="cursor: pointer;">
                                        <div class="panel-header">
                                            <div class="due-date text-center pull-right">28<br>June</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="panel-inner">
                                                <div class="panel-inner-content">
                                                    <h3>Task 1.5</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer" style="padding: 0;text-align: right;">
                                            <div class="icon-links quick-icon-links">
                                                <button data-toggle="tooltip" type="button" id="" title="Delete" class="btn btn icon-btn">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row completed-list" style="display: none;">
                                <table id="" class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Due Date</th>
                                            <th>Task Name</th>
                                            <th>Desscription</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>28 June</td>
                                            <td>Task 0.5</td>
                                            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
                                            <td>
                                                <div class="icon-links quick-icon-links">
                                                    <button data-toggle="tooltip" type="button" id="" title="Delete" class="btn btn icon-btn">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>28 June</td>
                                            <td>Task</td>
                                            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
                                            <td>
                                                <div class="icon-links quick-icon-links">
                                                    <button data-toggle="tooltip" type="button" id="" title="Delete" class="btn btn icon-btn">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>28 June</td>
                                            <td>Task 2.0</td>
                                            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
                                            <td>
                                                <div class="icon-links quick-icon-links">
                                                    <button data-toggle="tooltip" type="button" id="" title="Delete" class="btn btn icon-btn">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>28 June</td>
                                            <td>Task 1.5</td>
                                            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
                                            <td>
                                                <div class="icon-links quick-icon-links">
                                                    <button data-toggle="tooltip" type="button" id="" title="Delete" class="btn btn icon-btn">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                2017 © Synrgise.
                            </div>
                            <div class="col-xs-6">
                                <ul class="pull-right list-inline m-b-0">
                                    <li>
                                        <a href="#">About</a>
                                    </li>
                                    <li>
                                        <a href="#">Help</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div>
            <!-- end container -->


        </div>



        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-datepicker.js"></script>



        <script>

            $(document).ready(function(){

                $(".new-task-btn").click(function(){
                    $(".created-tasks").hide();
                    $(".new-button").hide();
                    $(".new-task_panel").fadeIn(500);
                });

                $(".create-btn").click(function(){
                    $(".new-task_panel").hide();
                    $(".new-button").fadeIn(500);
                    $(".created-tasks").fadeIn(500);
                });
           
                $("#list-view").click(function(){
                    $(".completed-blocks").hide();
                    $(".completed-list").fadeIn(500);
                    $(".list-view").addClass('text-primary');
                    $(".block-view").removeClass('text-primary');
                });
           
                $("#block-view").click(function(){
                    $(".completed-list").hide();
                    $(".completed-blocks").fadeIn(500);
                    $(".list-view").removeClass('text-primary');
                    $(".block-view").addClass('text-primary');
                });

                 $('body').on('focus',".date-input", function(){
                        console.log('datepicker');
                        $(this).datepicker({
                            format: 'yyyy-mm-dd'
                        });
                    });
            });

        </script>



    </body>
</html>