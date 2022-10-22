<?php 
    $datetime = new DateTime();
    $timenow = $datetime->format('H:i:s');
 ?>
                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                    รายงานผลจากพนักงานแผนก : <?php echo $_SESSION['Department']; ?>
                    </h2>
                </div>
                <!-- BEGIN: Pricing Layout -->
                <div class="intro-y box flex flex-col lg:flex-row mt-5">
                    <div class="intro-y flex-1 px-5 py-16" style="padding-top:0px">
                        <div class="font-medium mt-10"><span class="text-xl">แผนกที่ดูแล</span>
                            <a href="<?php echo site_url();?>/review" class="btn btn-secondary"><?php echo $_SESSION['Department']; ?></a><br><br> 
                        </div>     
                         <div class="w-full border-t border-gray-200 dark:border-dark-5 border-dashed"></div> <div class="w-full border-t border-gray-200 dark:border-dark-5 mt-5"></div> 
                        <div class="font-medium mt-10"><span class="text-xl">แผนกอื่นๆ</span>
                        <?php 
                            if($_SESSION['Department'] == 'ออกแบบ (Design)'){
                                echo "<a href='".site_url()."/review?depart=tams' class='btn btn-warning'>ขออนุญาตไฟฟ้า (TAMS)</a> ";
                                echo "<a href='".site_url()."/review?depart=admin' class='btn btn-danger'>เอกสาร (Admin)</a> ";
                                echo "<a href='".site_url()."/review?depart=other' class='btn btn-primary'>อื่นๆ (Other)</a> ";
                            }
                            elseif($_SESSION['Department'] == 'ขออนุญาตไฟฟ้า (TAMS)'){
                                echo "<a href='".site_url()."/review?depart=design' class='btn btn-primary'>ออกแบบ (Design)</a> ";
                                echo "<a href='".site_url()."/review?depart=admin' class='btn btn-warning'>เอกสาร (Admin)</a> ";
                                echo "<a href='".site_url()."/review?depart=other' class='btn btn-danger'>อื่นๆ (Other)</a> ";
                            }
                            elseif($_SESSION['Department'] == 'เอกสาร (Admin)'){
                                echo "<a href='".site_url()."/review?depart=design' class='btn btn-primary'>ออกแบบ (Design)</a> ";
                                echo "<a href='".site_url()."/review?depart=tams' class='btn btn-warning'>ขออนุญาตไฟฟ้า (TAMS)</a> ";
                                echo "<a href='".site_url()."/review?depart=other' class='btn btn-danger'>อื่นๆ (Other)</a> ";
                            }
                            elseif($_SESSION['Department'] == 'อื่นๆ (Other)'){
                                echo "<a href='".site_url()."/review?depart=design' class='btn btn-primary'>ออกแบบ (Design)</a> ";
                                echo "<a href='".site_url()."/review?depart=tams' class='btn btn-warning'>ขออนุญาตไฟฟ้า (TAMS)</a> ";
                                echo "<a href='".site_url()."/review?depart=admin' class='btn btn-danger'>เอกสาร (Admin)</a> ";
                            }
                        ?>
                        </div>
                        <br><br>  
                         <div class="w-full border-t border-gray-200 dark:border-dark-5 border-dashed"></div> <div class="w-full border-t border-gray-200 dark:border-dark-5 mt-5"></div>     
                        <div class="text-xl font-medium mt-10">สรุปงานแผนก : 
                        <?php 
                        if(isset($data->Department)){$datadepart = $data->Department;}else{$datadepart = '';}
                        echo $datadepart; 
                        ?>
                        </div>  
                        <div>   
                        <?php 
                                if(!isset($depart)){ 
                                    if(isset($data->Review_detail)){ // ตรวจสอบว่าแผนกปัจจุบันของเรานั้นมีการเพิ่มข้อมูลไปหรือยัง ถ้าเพิ่มแล้วจะทำปิดช่อง
                                        $disabled = 'disabled';
                                        $button = "<button class='btn btn-success' type='button'>บันทึกข้อมูลแล้ว</button>";
                                    }
                                    else{ // ถ้ายังไม่เพิ่มจะเปิดช่อง
                                        $disabled = '';
                                        $button = "<button class='btn btn-primary' type='submit'>บันทึกข้อมูล</button>";
                                    }
                                }
                                else{
                                    $disabled = 'disabled';
                                    $button = "";
                                }       

                                /* รายละเอียดสรุปงานแต่ละวัน */
                                if(isset($data->Review_detail)){ // ถ้ามีรายละเอียดของวันนี้ให้แสดงออกไป
                                    $detail = $data->Review_detail;
                                }
                                else{
                                    $detail = ''; // แต่ถ้าวันนี้ยังไม่ได้ใส่ให้แสดงเป็นค่าว่างแทน
                                }
                                
                            ?>
                            <form action="<?php echo site_url();?>/review?mode=add" method="POST"><br>                            
                                <textarea class="form-control form-control-user" <?php echo $disabled; ?> name="Review_detail"><?php echo $detail; ?></textarea><br>
                                <input type="hidden" name="Department" value="<?php echo $_SESSION['Department']; ?>">
                                <?php echo $button; ?>
                            </form>
                        </div>   
                    </div>
                    


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
                                <form action="review?filter=filtdate&depart=<?php echo $depart; ?>" method="POST">
                                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>                       
                                    <div class="relative w-56 mx-auto">                         
                                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4"> 
                                            <i data-feather="calendar" class="w-4 h-4"></i> 
                                        </div> 
                                        <input type="text" class="datepicker form-control pl-12" name="Datepick" data-single-mode="true" value="<?php echo $Datepick; ?>"> 
                                    </div>                                 
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="w-full border-t border-gray-200 dark:border-dark-5 border-dashed"></div> <div class="w-full border-t border-gray-200 dark:border-dark-5 mt-5"></div> 
                    <br>
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                            <th class="text-center whitespace-nowrap">ลำดับ</th>
                                            <th class="text-center whitespace-nowrap">ชื่อพนักงาน</th>
                                            <th class="text-center whitespace-nowrap">ตำแหน่ง</th>
                                            <th class="text-center whitespace-nowrap" width="10%">ลงชื่อ</th>
                                            <th class="text-center whitespace-nowrap">สรุปงาน</th>
                                            <th class="text-center whitespace-nowrap">ดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($reviews as $row){ ?>
                                    <tr>
                                            <td><?php echo $row['no']; ?></td>
                                            <td><?php echo $row['Person_name'].' '.$row['Person_sname'].' ('.$row['Person_niname'].')'; ?></td>
                                            <td><?php echo $row['Position']; ?></td>
                                            <td><?php echo $row['Time_loginm'].'<br>'.$row['Time_logina'].'<br>'.$row['Time_logout']; ?></td>
                                            <td><?php echo $row['Time_logout_reason']; ?></td>
                                            <td><?php echo $row['Button']; ?></td>
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