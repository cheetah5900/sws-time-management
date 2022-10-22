<!-- END: Head -->

<body class="main">
    <!-- BEGIN: Mobile Menu -->
    <div class="mobile-menu md:hidden">
        <div class="mobile-menu-bar">
            <a href="" class="flex mr-auto">
                <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="<?php echo base_url(); ?>assets/dist/images/logo.svg">
            </a>
            <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        </div>
        <ul class="border-t border-theme-29 py-5 hidden">
            <a href="<?php echo site_url(); ?>" class="menu">
                <div class="menu__icon"> <i data-feather="inbox"></i> </div>
                <div class="menu__title"> ลงเวลางาน </div>
            </a>
            <?php if ($_SESSION['Level'] == 'Root' || $_SESSION['Level'] == 'Boss') { ?>
                <a href="<?php echo site_url('review'); ?>" class="menu">
                    <div class="menu__icon"> <i data-feather="list"></i> </div>
                    <div class="menu__title"> ตรวจงาน </div>
                </a>
            <?php } ?>
            <?php if ($_SESSION['Level'] == 'Root') { ?>
                <a href="<?php echo site_url('conclude'); ?>" class="menu">
                    <div class="menu__icon"> <i data-feather="archive"></i> </div>
                    <div class="menu__title"> สรุปงาน </div>
                </a>
            <?php } ?>
            <?php if ($_SESSION['Level'] == 'Root') { ?>
                <a href="<?php echo site_url('person'); ?>" class="menu">
                    <div class="menu__icon"> <i data-feather="user"></i> </div>
                    <div class="menu__title"> พนักงาน </div>
                </a>
            <?php } ?>
            <?php if ($_SESSION['Level'] == 'HR' || $_SESSION['Level'] == 'Root') { ?>
                <a href="<?php echo site_url('hr'); ?>" class="menu">
                    <div class="menu__icon"> <i data-feather="users"></i> </div>
                    <div class="menu__title"> Export </div>
                </a>
            <?php } ?>
        </ul>
    </div>
    <!-- END: Mobile Menu -->
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a href="<?php echo site_url(); ?>" class="intro-x flex items-center pl-5 pt-4">
                <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="<?php echo base_url(); ?>assets/dist/images/logo.svg">
                <span class="hidden xl:block text-white text-lg ml-3"> SWS - Time Management </span>
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                <li>
                </li>

                <li>
                    <a href="<?php echo site_url(); ?>" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
                        <div class="side-menu__title"> ลงเวลางาน </div>
                    </a>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="alert-triangle"></i> </div>
                        <div class="side-menu__title">
                            ปัญหาที่พบ
                            <div class="side-menu__sub-icon"> <i data-feather="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="<?php echo site_url('problem'); ?>?type=2" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="alert-circle"></i> </div>
                                <div class="side-menu__title"> ปัญหาที่ยังไม่ถึงกำหนด </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('problem'); ?>?type=3" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="tool"></i> </div>
                                <div class="side-menu__title"> ปัญหาที่แก้แล้ว </div>
                            </a>
                        </li>
                    </ul>
                    <?php if ($_SESSION['Level'] == 'Root' || $_SESSION['Level'] == 'Boss') { ?>
                        <a href="<?php echo site_url('review'); ?>" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                            <div class="side-menu__title"> ตรวจงาน </div>
                        </a>
                    <?php } ?>
                    <?php if ($_SESSION['Level'] == 'Root') { ?>
                        <a href="<?php echo site_url('conclude'); ?>" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="archive"></i> </div>
                            <div class="side-menu__title"> สรุปงาน </div>
                        </a>
                    <?php } ?>
                    <?php if ($_SESSION['Level'] == 'Root') { ?>
                        <a href="<?php echo site_url('person'); ?>" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="user"></i> </div>
                            <div class="side-menu__title"> พนักงาน </div>
                        </a>
                    <?php } ?>
                    <?php if ($_SESSION['Level'] == 'HR' || $_SESSION['Level'] == 'Root') { ?>
                        <a href="<?php echo site_url('hr'); ?>" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                            <div class="side-menu__title"> HR </div>
                        </a>
                    <?php } ?>
                </li>
            </ul>
            </li>
            </ul>
        </nav>
        <!-- END: Side Menu -->