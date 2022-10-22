
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
                            สร้างบัญชี
                        </h2>
                        <div class="intro-x mt-8">
                            <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block" name="Person_name" placeholder="ชื่อจริง">
                            <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Person_sname" placeholder="นามสกุล">
                            <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Person_niname" placeholder="ชื่อเล่น">
                            <input required type = "number" maxlength = "10" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Phone" placeholder="เบอร์โทร (ไม่มีขีด)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Position" placeholder="ตำแหน่ง">
                            
                            <select name="Department" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4">
                                <option value="อื่นๆ (Other)">เลือกแผนก</option>
                                <option value="ออกแบบ (Design)">ออกแบบ (Design)</option>
                                <option value="ขออนุญาตไฟฟ้า (TAMS)">ขออนุญาตไฟฟ้า (TAMS)</option>
                                <option value="เอกสาร (Admin)">เอกสาร (Admin)</option>
                                <option value="อื่นๆ (Other)">อื่นๆ (Other)</option>
                            </select>
                            <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Username" placeholder="username" id="forcelower" onkeyup="return forceLower(this);">
                            <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Password" placeholder="password">
                            <br>รูปพนักงาน
                            <input required type="file" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"  name="File_person" >
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">ลงทะเบียน</button>
                            <a href="login" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">เข้าสู่ระบบ</a>
                        </div>
                    </form>
                    </div>
                </div>
                <!-- END: Register Form -->
            </div>
        </div>