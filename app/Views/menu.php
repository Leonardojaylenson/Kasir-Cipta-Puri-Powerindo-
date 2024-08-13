
<?php
$activePage = basename($_SERVER['REQUEST_URI']);

?>

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav menu">
                <?php foreach ($menus as $menu) : ?>
                    <li class="<?= !empty($menu->subMenus) ? 'menu-item-has-children dropdown' : '' ?>">
                        <a href="<?= base_url($menu->url ?? '') ?>" class="<?= !empty($menu->subMenus) ? 'dropdown-toggle' : '' ?>" data-toggle="<?= !empty($menu->subMenus) ? 'dropdown' : '' ?>" aria-haspopup="true" aria-expanded="false">
                            <i class="<?= $menu->icon ?>"></i>
                            <?= $menu->title ?>
                        </a>
                        <?php if (!empty($menu->subMenus)) : ?>
                            <ul class="sub-menu children dropdown-menu">
                                <?php foreach ($menu->subMenus as $subMenu) : ?>
                                    <li>
                                        <a href="<?= base_url($subMenu->url ?? '') ?>">
                                            <i class="<?= $subMenu->icon ?>"></i>
                                            <?= $subMenu->title ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>





    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="<?=base_url('images/'.$setting->menu_icon)?>" alt="Logo" width="91px" heigh></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                       

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="<?=base_url('images/'.$dua->foto)?>" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="<?=base_url('home/profile')?>"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="<?=base_url('home/changepassword')?>"><i class="fa fa -cog"></i>Change Password</a>

                            <a class="nav-link" href="<?=base_url('home/logout')?>"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
