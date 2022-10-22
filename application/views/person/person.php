<?php 
    $datetime = new DateTime();
    $timenow = $datetime->format('H:i:s');
 ?>
 
                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                    เพิ่มข้อมูลพนักงาน
                    </h2>
                </div>
                <!-- BEGIN: Pricing Layout -->
                <div class="intro-y box flex flex-col lg:flex-row mt-5">
                    <div class="intro-y flex-1 px-5 py-16">
                        <div class="text-xl font-medium text-center mt-10">รายละเอียดทั่วไป</div><br><br>   
                            <form action="<?php echo site_url('person?mode=add');?>" method="POST" enctype="multipart/form-data">                           
                            <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block" name="Person_name" placeholder="ชื่อจริง">
                            <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Person_sname" placeholder="นามสกุล">
                            <input required type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Person_niname" placeholder="ชื่อเล่น">
                            <input required type = "number" maxlength = "10" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" name="Phone" placeholder="เบอร์โทร (ไม่มีขีด)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

                            <br>รูปพนักงาน
                            <input required type="file" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"  name="File_person" >                     
                       
                    </div>
                    
                    <div class="intro-y border-b border-t lg:border-b-0 lg:border-t-0 flex-1 p-5 lg:border-l lg:border-r border-gray-200 dark:border-dark-5 py-16">
                        <div class="text-xl font-medium text-center mt-10">ข้อมูลอื่นๆ</div><br>                                
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
                            <br>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                ลำดับขั้น<br><br>
                                <select name="Level" class="form-control form-control-user">
                                <option value="Officer">พนักงาน</option>
                                <option value="Boss">หัวหน้าแผนก</option>
                                <option value="Root">Root</option>
                                </select>
                            </div>
                    </div>
                        <button type="submit" class="btn btn-primary btn-user">บันทึกข้อมูล</button>
                </form>
                </div>
                <!-- END: Pricing Layout -->
                <!-- BEGIN: Pricing Layout -->
                <br><br><br><br><br>
                
                     <!-- BEGIN: Data List -->
                     <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                        ทั้งหมด <?php echo $total_rows.' รายการ'; ?>
                        <div class="hidden md:block mx-auto text-gray-600">
                    
                                <!-- BEGIN: Pagination -->
                                <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                                    <ul class="pagination">
                                        <li> <?php echo $links; ?> </li>
                                    </ul>
                                </div>
                                <!-- END: Pagination -->                    
                        </div>
                        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                            <div class="w-56 relative text-gray-700 dark:text-gray-300">
                                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i> 
                                <div class="relative w-56 mx-auto"> 
                                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4"> 
                                        <i data-feather="calendar" class="w-4 h-4"></i> 
                                    </div> 
                                    <input disabled type="text" class="datepicker form-control pl-12" data-single-mode="true"> 
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="w-full border-t border-gray-200 dark:border-dark-5 border-dashed"></div> <div class="w-full border-t border-gray-200 dark:border-dark-5 mt-5"></div> 
                    <br>
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th>ชื่อพนักงาน</th>
                                    <th>เบอร์</th>
                                    <th>ตำแหน่ง</th>
                                    <th>แผนก</th>
                                    <th>ลำดับขั้น</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>รูป</th>
                                    <th>ดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($persons as $row){ ?>
                                    <tr>
                                        <td><?php echo $row['Person_name'].' '.$row['Person_sname']; ?></td>
                                        <td><?php echo $row['Phone']; ?></td>
                                        <td><?php echo $row['Position']; ?></td>
                                        <td><?php echo $row['Department']; ?></td>
                                        <td><?php echo $row['Level']; ?></td>
                                        <td><?php echo $row['Username']; ?></td>
                                        <td><?php echo $row['Password']; ?></td>
                                        <td><?php echo $row['File_person']; ?></td>
                                        <td>
                                            <a class="btn btn-warning" href="<?php echo site_url('person?mode=edit&id=').$row['Person_id']; ?>">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a class="btn btn-danger" onclick="return confirm('ยืนยันลบใช่หรือไม่');" href="<?php echo site_url('person?mode=del&id=').$row['Person_id']; ?>">
                                                <i data-feather="trash-2"></i>
                                            </a>
                                        </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- END: Data List -->
                <!-- END: Pricing Layout -->
            </div>
            <!-- END: Content -->
        </div>