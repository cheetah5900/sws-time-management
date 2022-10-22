            <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                    เพิ่มข้อมูลพนักงาน
                    </h2>
                </div>
                <!-- BEGIN: Pricing Layout -->
                <div class="intro-y box flex flex-col lg:flex-row mt-5">
                    <div class="intro-y flex-1 px-5 py-16">
                        <div class="text-xl font-medium text-center mt-10">รายละเอียดทั่วไป</div><br><br>   
                            <form action="<?php echo site_url('person?mode=editdata');?>" method="POST" enctype="multipart/form-data">                              
                            <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block" name="Person_name" placeholder="ชื่อจริง" value="<?php echo $query->Person_name;?>">
                            <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Person_sname" placeholder="นามสกุล" value="<?php echo $query->Person_sname;?>">
                            <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Person_niname" placeholder="ชื่อเล่น" value="<?php echo $query->Person_niname;?>">
                            <input required type = "number" maxlength = "10" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Phone" placeholder="เบอร์โทร (ไม่มีขีด)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo $query->Phone;?>">
                    </div>
                    
                    <div class="intro-y border-b border-t lg:border-b-0 lg:border-t-0 flex-1 p-5 lg:border-l lg:border-r border-gray-200 dark:border-dark-5 py-16">
                        <div class="text-xl font-medium text-center mt-10">ข้อมูลอื่นๆ</div><br>                                
                        <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Position" placeholder="ตำแหน่ง" value="<?php echo $query->Position;?>">
                        <br>
                            <select name="Department" class="form-control form-control-user">
                                <option <?php if($query->Department == 'ออกแบบ (Design)'){echo "selected";}?> value="ออกแบบ (Design)">ออกแบบ (Design)</option>
                                <option <?php if($query->Department == 'ขออนุญาตไฟฟ้า (TAMS)'){echo "selected";}?> value="ขออนุญาตไฟฟ้า (TAMS)">ขออนุญาตไฟฟ้า (TAMS)</option>
                                <option <?php if($query->Department == 'เอกสาร (Admin)'){echo "selected";};?> value="เอกสาร (Admin)">เอกสาร (Admin)</option>
                                <option <?php if($query->Department == 'อื่นๆ (Other)'){echo "selected";};?> value="อื่นๆ (Other)">อื่นๆ (Other)</option>
                            </select><br>
                            <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Username" placeholder="username" id="forcelower" onkeyup="return forceLower(this);" value="<?php echo $query->Username;?>">
                            <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Password" placeholder="password" value="<?php echo $query->Password;?>">
                            <br>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <select name="Level" class="form-control form-control-user">
                                <option <?php if($query->Level == 'Officer'){echo "selected";}?> value="Officer">พนักงาน</option>
                                <option <?php if($query->Level == 'Boss'){echo "selected";}?> value="Boss">หัวหน้าแผนก</option>
                                <option <?php if($query->Level == 'Root'){echo "selected";}?> value="Root">Root</option>
                                </select><br>
                            </div>
                    </div>
                        <button type="submit" class="btn btn-primary btn-user">บันทึกข้อมูล</button>
                        <input type="hidden" name="Person_id" value="<?php echo $query->Person_id;?>"><br>
                </form>
                </div>
                <!-- END: Pricing Layout -->
            </div>
            <!-- END: Content -->
        </div>









