                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                    ดาวน์โหลดข้อมูลลงชื่อ
                    </h2>
                </div>
                <!-- BEGIN: Pricing Layout -->
                <div class="intro-y box flex flex-col lg:flex-row mt-5">
                <form action="<?php echo site_url('hr'); ?>" method="GET">
                    <div class="intro-y flex-1 px-5 py-16" style="padding-top:0px">  
                        <div class="font-medium mt-10">
                            <span class="text-xl">เดือน </span>
                            <select name="Monthpick" class="form-control" style="width:150px">
                                <option value="01" <?php echo ($Monthpick == '01') ? 'selected' : '' ?>>มกราคม</option>
                                <option value="02"<?php echo ($Monthpick == '02') ? 'selected' : '' ?>>กุมภาพันธ์</option>
                                <option value="03"<?php echo ($Monthpick == '03') ? 'selected' : '' ?>>มีนาคม</option>
                                <option value="04"<?php echo ($Monthpick == '04') ? 'selected' : '' ?>>เมษายน</option>
                                <option value="05"<?php echo ($Monthpick == '05') ? 'selected' : '' ?>>พฤษภาคม</option>
                                <option value="06"<?php echo ($Monthpick == '06') ? 'selected' : '' ?>>มิถุนายน</option>
                                <option value="07"<?php echo ($Monthpick == '07') ? 'selected' : '' ?>>กรกฎาคม</option>
                                <option value="08"<?php echo ($Monthpick == '08') ? 'selected' : '' ?>>สิงหาคม</option>
                                <option value="09"<?php echo ($Monthpick == '09') ? 'selected' : '' ?>>กันยายน</option>
                                <option value="10"<?php echo ($Monthpick == '10') ? 'selected' : '' ?>>ตุลาคม</option>
                                <option value="11"<?php echo ($Monthpick == '11') ? 'selected' : '' ?>>พฤศจิกายน</option>
                                <option value="12"<?php echo ($Monthpick == '12') ? 'selected' : '' ?>>ธันวาคม</option>
                            </select>
                            <br><br><br>
                            <span class="text-xl">ปี พ.ศ.</span>
                            <input disabled class="form-control" style="width:150px;" value="2564">
                            <br><br><br>
                            <button class="btn btn-primary" type="submit">ค้นหา</button>
                            <br><br><br>
                            <button class="btn btn-success" type="submit" value="dl" name="btndl">ดาวน์โหลด</button>
                        </div> 
                    </div>                    
                </form>

                </div>
                <!-- END: Pricing Layout -->
                <!-- BEGIN: Pricing Layout -->
                <br><br><br>
                
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
                                            <th class="text-center whitespace-nowrap">วันที่</th>
                                            <th class="text-center whitespace-nowrap" width="10%">เวลา</th>
                                            <th class="text-center whitespace-nowrap">สรุปงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($reviews as $row){ ?>
                                    <tr>
                                            <td><?php echo $row['no']; ?></td>
                                            <td><?php echo $row['Person_name'].' '.$row['Person_sname'].' ('.$row['Person_niname'].')'; ?></td>
                                            <td><?php echo $row['Position']; ?></td>
                                            <td><?php echo $row['Date']; ?></td>
                                            <td><?php echo $row['Time_loginm'].'<br>'.$row['Time_logina'].'<br>'.$row['Time_logout']; ?></td>
                                            <td><?php echo $row['Time_logout_reason']; ?></td>
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