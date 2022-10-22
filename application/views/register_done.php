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
                <!-- BEGIN: Register Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <form class="user" action="register?mode=add" method="POST" enctype="multipart/form-data">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        ลงทะเบียนสำเร็จ สามารถเข้าสู่ระบบได้ทันที
                        </h2>

                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <a href="<?php echo site_url('login');?>" class="btn btn-success">กดที่นี่เพื่อเข้าสู่ระบบ</a>
                        </div>
                    </form>
                    </div>
                </div>
                <!-- END: Register Form -->
            </div>
        </div>