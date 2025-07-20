<aside class="aside">
    <nav class="sidebar">
        <?php
        $UserPhotoUrl = GetDefaultUserProfile($RowUsreInfo['photo']);
        ?>
        <div class="item user-block">
            <div class="user-block-picture">
                <div class="user-block-status">
                    <img src="<?php echo $UserPhotoUrl ?>" width="60" height="60" class="img-thumbnail img-circle">
                    <div class="point point-success point-lg"></div>
                </div>
            </div>
            <div class="user-block-info">
                <span class="user-block-name item-text"><?php echo $AdminLangFile['home_welcome'] ?></span>
                <span class="user-block-role"><?php echo $RowUsreInfo['name'] . "" ?></span>
            </div>
        </div>

        <ul class="nav">
            <li class="nav-heading"></li>
            <?php
            $Admin_Menu = $db->SelArr("SELECT * FROM x_admin_menu where state = '1' ORDER BY postion ASC");

            for ($i = 0; $i < count($Admin_Menu); $i++) {
                if (ADMIN_WEB_LANG == 'En') {
                    $Admin_Menu[$i]['name'] = $Admin_Menu[$i]['name_en'];
                }

                $MainAdminMenuId = $Admin_Menu[$i]['id'];

##############################################################################################################################################################
################################ Menu For Users
##############################################################################################################################################################

                if (isset($AdminGroup[$Admin_Menu[$i]['cat_id']]) and $AdminGroup[$Admin_Menu[$i]['cat_id']] == '1'
                    and isset($AdminConfig[$Admin_Menu[$i]['cat_id']]) and $AdminConfig[$Admin_Menu[$i]['cat_id']] == '1'
                    and $Admin_Menu[$i]['count_unit_a'] >= '1') {

                    echo '<li class="' . CheckAdminMenu(strtoupper($Admin_Menu[$i]['cat_id'])) . '">';
                    echo '<a href="#" title="' . $Admin_Menu[$i]['name'] . '" data-toggle="collapse-next" class="has-submenu"><em class="fa ' . $Admin_Menu[$i]['icon'] . '"></em>';
                    echo '<span class="item-text item-text_ul">' . $Admin_Menu[$i]['name'] . '</span></a>';

                    echo '<!-- START SubMenu item-->';
                    echo '<ul class="nav collapse ' . CheckAdminMenu2(strtoupper($Admin_Menu[$i]['cat_id'])) . '">';


                    $SubMenu = $db->SelArr("SELECT * FROM x_admin_menu_sub where cat_id = '$MainAdminMenuId' and state = '1' ORDER BY postion ASC");
                    for ($x = 0; $x < count($SubMenu); $x++) {
                        if (ADMIN_WEB_LANG == "En") {
                            $SubMenu[$x]['name'] = $SubMenu[$x]['name_en'];
                        }
                        if ($SubMenu[$x]['admin_view'] != '1') {
                            echo '<li class="' . CheckAdminMenuLi(strtoupper($Admin_Menu[$i]['cat_id']) . $SubMenu[$x]['views']) . '" >
<a href="' . $AdminPathHome . $SubMenu[$x]['path'] . '/index.php?view=' . $SubMenu[$x]['views'] . '" data-toggle="" class="no-submenu">';
                            echo '<span class="item-text item-text_li">' . $SubMenu[$x]['name'] . '</span></a></li>';
                        } else {
                            if ($AdminConfig['web_manage'] == '1') {
                                echo '<li class="' . CheckAdminMenuLi(strtoupper($Admin_Menu[$i]['cat_id']) . $SubMenu[$x]['views']) . '" >
<a href="' . $AdminPathHome . $SubMenu[$x]['path'] . '/index.php?view=' . $SubMenu[$x]['views'] . '" data-toggle="" class="no-submenu">';
                                echo '<span class="item-text item-text_li">' . $SubMenu[$x]['name'] . '</span></a></li>';
                            }
                        }


                    }

                    echo '</ul></li>';

##############################################################################################################################################################
################################ Menu For Web Admin
##############################################################################################################################################################

                } elseif (isset($AdminGroup[$Admin_Menu[$i]['cat_id']]) and $AdminGroup[$Admin_Menu[$i]['cat_id']] == '1' and $Admin_Menu[$i]['web_admin'] == '1'
                    and $AdminConfig['web_manage'] == '1' and $Admin_Menu[$i]['count_unit_a'] >= '1') {

                    echo '<li class="' . CheckAdminMenu(strtoupper($Admin_Menu[$i]['cat_id'])) . '">';
                    echo '<a href="#" title="' . $Admin_Menu[$i]['name'] . '" data-toggle="collapse-next" class="has-submenu"><em class="fa ' . $Admin_Menu[$i]['icon'] . ' "></em>';
                    echo '<span class="item-text item-text_ul">' . $Admin_Menu[$i]['name'] . '</span></a>';

                    echo '<!-- START SubMenu item-->';
                    echo '<ul class="nav collapse ' . CheckAdminMenu2(strtoupper($Admin_Menu[$i]['cat_id'])) . '">';

                    $SubMenu = $db->SelArr("SELECT * FROM x_admin_menu_sub where cat_id = '$MainAdminMenuId' and state = '1' ORDER BY postion ASC");
                    for ($x = 0; $x < count($SubMenu); $x++) {
                        if (ADMIN_WEB_LANG == "En") {
                            $SubMenu[$x]['name'] = $SubMenu[$x]['name_en'];
                        }
                        echo '<li class="' . CheckAdminMenuLi(strtoupper($Admin_Menu[$i]['cat_id']) . $SubMenu[$x]['views']) . '" >
<a href="' . $AdminPathHome . $SubMenu[$x]['path'] . '/index.php?view=' . $SubMenu[$x]['views'] . '" data-toggle="" class="no-submenu">';
                        echo '<span class="item-text item-text_li">' . $SubMenu[$x]['name'] . '</span></a></li>';

                    }

                    echo '</ul></li>';

##############################################################################################################################################################
################################ Menu For Super Admin
##############################################################################################################################################################

                } elseif (isset($AdminGroup[$Admin_Menu[$i]['cat_id']]) and $AdminGroup[$Admin_Menu[$i]['cat_id']] == '1' and ArrIsset($AdminConfig ,'admin',null) == '1' and $Admin_Menu[$i]['freestyle'] == '0'
                    and $Admin_Menu[$i]['count_unit_a'] >= '1') {

                    echo '<li class="' . CheckAdminMenu(strtoupper($Admin_Menu[$i]['cat_id'])) . '">';
                    echo '<a href="#" title="' . $Admin_Menu[$i]['name'] . '" data-toggle="collapse-next" class="has-submenu"><em class="fa  ' . $Admin_Menu[$i]['icon'] . '"></em>';
                    echo '<span class="item-text item-text_ul">' . $Admin_Menu[$i]['name'] . '</span></a>';

                    echo '<!-- START SubMenu item-->';
                    echo '<ul class="nav collapse ' . CheckAdminMenu2(strtoupper($Admin_Menu[$i]['cat_id'])) . '">';


                    $SubMenu = $db->SelArr("SELECT * FROM x_admin_menu_sub where cat_id = '$MainAdminMenuId' and state = '1' ORDER BY postion ASC");
                    for ($x = 0; $x < count($SubMenu); $x++) {
                        if (ADMIN_WEB_LANG == "En") {
                            $SubMenu[$x]['name'] = $SubMenu[$x]['name_en'];
                        }
                        echo '<li class="' . CheckAdminMenuLi(strtoupper($Admin_Menu[$i]['cat_id']) . $SubMenu[$x]['views']) . '" >
<a href="' . $AdminPathHome . $SubMenu[$x]['path'] . '/index.php?view=' . $SubMenu[$x]['views'] . '" data-toggle="" class="no-submenu">';
                        echo '<span class="item-text item-text_li">' . $SubMenu[$x]['name'] . '</span></a></li>';
                    }

                    echo '</ul></li>';


##############################################################################################################################################################
################################ Menu For FreeStyle
##############################################################################################################################################################

                } elseif (isset($AdminGroup[$Admin_Menu[$i]['cat_id']]) and $AdminGroup[$Admin_Menu[$i]['cat_id']] == '1' and ArrIsset($AdminConfig ,'admin',null) == '1' and $Admin_Menu[$i]['freestyle'] == '1' and FREESTYLE4U_EDIT == '1'
                    and $Admin_Menu[$i]['count_unit_a'] >= '1') {
                    /*  */
                    echo '<li class="' . CheckAdminMenu(strtoupper($Admin_Menu[$i]['cat_id'])) . '">';
                    echo '<a href="#" title="' . $Admin_Menu[$i]['name'] . '" data-toggle="collapse-next" class="has-submenu"><em class="fa  ' . $Admin_Menu[$i]['icon'] . '"></em>';
                    echo '<span class="item-text item-text_ul">' . $Admin_Menu[$i]['name'] . '</span></a>';

                    echo '<!-- START SubMenu item-->';
                    echo '<ul class="nav collapse ' . CheckAdminMenu2(strtoupper($Admin_Menu[$i]['cat_id'])) . '">';


                    $SubMenu = $db->SelArr("SELECT * FROM x_admin_menu_sub where cat_id = '$MainAdminMenuId' and state = '1' ORDER BY postion ASC");
                    for ($x = 0; $x < count($SubMenu); $x++) {
                        if (ADMIN_WEB_LANG == "En") {
                            $SubMenu[$x]['name'] = $SubMenu[$x]['name_en'];
                        }
                        echo '<li class="' . CheckAdminMenuLi(strtoupper($Admin_Menu[$i]['cat_id']) . $SubMenu[$x]['views']) . '" >
<a href="' . $AdminPathHome . $SubMenu[$x]['path'] . '/index.php?view=' . $SubMenu[$x]['views'] . '" data-toggle="" class="no-submenu">';
                        echo '<span class="item-text item-text_li">' . $SubMenu[$x]['name'] . '</span></a></li>';
                    }

                    echo '</ul></li>';

                }


            }


            ?>

        </ul>
    </nav>
</aside>
