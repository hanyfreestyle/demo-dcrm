<?php
$Contacts_Button = '0';
$Search_Button = '0';
?>
<nav role="navigation" class="navbar navbar-default navbar-top navbar-fixed-top">


    <div class="navbar-header hany"><a href="<?php echo $AdminPathHome ?>" class="navbar-brand">
            <div class="brand-logo"><img src="<?php echo $AdminPath ?>app/img/logo.png" alt="App Logo"
                                         class="img-responsive CAdmin_Logo"></div>
            <div class="brand-logo-collapsed"><img src="<?php echo $AdminPath ?>app/img/logo-single.png" alt="App Logo"
                                                   class="img-responsive"></div>
        </a></div>


    <div class="nav-wrapper">
        <ul class="nav navbar-nav">

            <?php
            echo '<li>';
            echo '<a href="#" data-toggle-state="aside-collapsed" data-persists="true" class="hidden-xs"><em class="fa fa-navicon"></em></a>';
            echo '<a href="#" data-toggle-state="aside-toggled" class="visible-xs"><em class="fa fa-navicon"></em></a>';
            echo '</li>';


            //echo '<li><a href="#" data-toggle="reset" style="display: none;"><em class="fa fa-refresh"></em></a></li>';
            //// refresh
            if (ArrIsset($AdminConfig ,'admin',null) == '1') {
                echo '<li><a href="' . $AdminPathHome . 'Backup/index.php?view=List"><em class="fa fa-archive topmenu_fa"></em></a></li>';
            }

            //// User
            echo '<li class="dropdown">';
            echo '<a href="#" data-toggle="dropdown" data-play="fadeIn" class="dropdown-toggle"><em class="fa fa-user topmenu_fa"></em></a>';
            echo '<ul class="dropdown-menu dropdown-menu_Ar">';
            echo '<li><a  href="' . $AdminPathHome . 'include/Page_ChangLang.php">' . $AdminLangFile['webconfig_li_chang_lang'] . '</a></li>';
            echo '<li class="divider"></li>';

            if ($AdminConfig['teamleader'] == '1') {
                if ($RowUsreInfo['team_leader'] == '1') {
                    echo '<li><a  href="' . $AdminPathHome . 'UserProfile/index.php?view=TeamLeader&active=0">' . $AdminLangFile['users_unactive_team_leader'] . '</a></li>';
                } else {
                    echo '<li><a  href="' . $AdminPathHome . 'UserProfile/index.php?view=TeamLeader&active=1">' . $AdminLangFile['users_active_team_leader'] . '</a></li>';
                }
                echo '<li class="divider"></li>';
            }

            if ($AdminConfig['custservleader'] == '1') {
                if ($RowUsreInfo['custserv_leader'] == '1') {
                    echo '<li><a  href="' . $AdminPathHome . 'UserProfile/index.php?view=CustTeamLeader&active=0">' . $AdminLangFile['users_unactive_custserv_leader'] . '</a></li>';
                } else {
                    echo '<li><a  href="' . $AdminPathHome . 'UserProfile/index.php?view=CustTeamLeader&active=1">' . $AdminLangFile['users_active_custserv_leader'] . '</a></li>';
                }
                echo '<li class="divider"></li>';
            }


            if ($AdminConfig['userprofile'] == '1') {
                echo '<li><a  href="' . $AdminPathHome . 'UserProfile/index.php?view=UserProfile">' . $AdminLangFile['users_user_profile'] . '</a></li>';
                echo '<li class="divider"></li>';
                echo '<li><a  href="' . $AdminPathHome . 'UserProfile/index.php?view=ChangePassword">' . $AdminLangFile['users_changepassword'] . '</a></li>';
                echo '<li class="divider"></li>';
            }

            echo '<li><a href="' . $AdminPathHome . 'index.php?logout">' . $AdminLangFile['dashboard_logout'] . '</a></li>';
            echo '<li class="divider"></li>';
            echo '</ul>';
            echo '</li>';

            if (ArrIsset($AdminConfig ,'admin',null) == '1') {
                echo '<li><a href="' . $AdminPathHome . 'Permission/index.php?view=OnlineList"><em class="fa fa-clock-o topmenu_fa"></em></a></li>';
            }

            if (ArrIsset($AdminConfig ,'admin',null) == '1' and FREESTYLE4U_EDIT == '1') {
                echo '<li><a href="' . $AdminPathHome . 'Leads/index.php?view=List"><em class="fa fa-random topmenu_fa"></em></a></li>';
                echo '<li><a href="' . $AdminPathHome . 'LangAdmin/index.php?view=List"><em class="fa fa-language topmenu_fa"></em></a></li>';
            }

            echo '<li><a title="اللوائح"  href="' . $AdminPathHome . 'UserProfile/index.php?view=Regulations"><em class="fa fa-book topmenu_fa"></em></a></li>';
            echo '<li><a title="الملاحظات" href="' . $AdminPathHome . 'UserProfile/index.php?view=Notes"><em class="fa fa-comment topmenu_fa"></em></a></li>';
            ?>
        </ul>


        <!-- START Right Navbar-->
        <ul class="nav navbar-nav navbar-right">

            <?php

            if ($Search_Button == '1') {
                echo '<li><a href="#" data-toggle="navbar-search"><em class="fa fa-search"></em></a></li>';
            }
            ?>

            <!-- START Alert menu-->
            <li class="dropdown dropdown-list" style="display: none;">
                <a href="#" data-toggle="dropdown" data-play="fadeIn" class="dropdown-toggle">
                    <em class="fa fa-bell-o"></em>
                    <div class="label label-info">35</div>
                </a>

                <!-- START Dropdown menu-->
                <ul class="dropdown-menu">
                    <li>

                        <!-- START list group-->
                        <div class="list-group">

                            <!-- list item-->
                            <a href="#" class="list-group-item">
                                <div class="media">
                                    <div class="pull-left">
                                        <em class="fa fa-envelope-o fa-2x text-success"></em>
                                    </div>

                                    <div class="media-body clearfix">
                                        <div class="media-heading">Unread messages</div>
                                        <p class="m0">
                                            <small>You have 10 unread messages</small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- list item-->


                            <!-- last list item -->
                            <a href="#" class="list-group-item">
                                <small>Unread notifications</small>
                                <span class="badge">14</span>
                            </a>
                        </div>
                        <!-- END list group-->

                    </li>
                </ul>
                <!-- END Dropdown menu-->
            </li>
            <!-- END Alert menu-->


            <li class="TopMenuDate"><a><?php echo date('Y-m-d'); ?></a></li>

            <?php
            $Contacts_Button = '1x';
            if ($Contacts_Button == '1') {
                echo '<li>';
                echo '<a href="#" data-toggle-state="offsidebar-open">';
                echo '<em class="fa fa-comment-o"></em>';
                echo '</a>';
                echo '</li>';
            }
            ?>
        </ul>
    </div>

    <?php
    if ($Search_Button == '1') {
        echo '<form role="search" class="navbar-form">';
        echo '<div class="form-group has-feedback">';
        echo '<input type="text" placeholder="Type and hit Enter.." class="form-control">';
        echo '<div data-toggle="navbar-search-dismiss" class="fa fa-times form-control-feedback"></div>';
        echo '</div>';
        echo '<button type="submit" class="hidden btn btn-default">Submit</button>';
        echo '</form>';
    }
    ?>

</nav>
<!-- END Top Navbar-->