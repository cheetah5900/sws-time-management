
    <!-- END: Head -->
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="<?php echo base_url();?>assets/dist/images/logo.svg">
                        <span class="text-white text-lg ml-3"> SWS - Time management </span>
                    </a>
                    <div class="my-auto">
                        <img alt="Rubick Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="<?php echo base_url();?>assets/dist/images/illustration.svg">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            ระบบบริหารจัดการด้านเวลา
                            <br>
                            ศรีสมวงศ์เทเลเซลล์
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-gray-500">จัดการเรื่องการลงชื่อ ลา วันหยุด และผลการทำงานประจำวัน</div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            เข้าสู่ระบบ
                        </h2>
                        <form action="<?php echo site_url('login/validation')?>" method="POST">
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">ระบบบริหารจัดการด้านเวลา ศรีสมวงศ์เทเลเซลล์ จัดการเรื่องการลงชื่อ ลา วันหยุด และผลการทำงานประจำวัน</div>
                        <div class="intro-x mt-8">
                            <input required id="forcelower" onkeyup="return forceLower(this);" type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block" name="Username" placeholder="Username">
                            <input type="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"  name="Password" placeholder="password">                            
                            <?php echo $popup; ?>
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top" type="submit">เข้าสู่ระบบ</button>
                            <a class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top" href="register">ลงทะเบียน</a>
                        </div>
                        </form>                        
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
        <!-- BEGIN: Dark Mode Switcher-->
        <!-- <div data-url="login-dark-login.html" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
            <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
            <div class="dark-mode-switcher__toggle border"></div>
        </div> -->
        <!-- END: Dark Mode Switcher-->
        <!-- BEGIN: JS Assets-->
        <script src="<?php echo base_url();?>assets/dist/js/app.js"></script>
        <!-- END: JS Assets-->
    </body>
</html>