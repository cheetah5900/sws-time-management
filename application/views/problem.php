 
              <?php 
              echo $popup;
              //TODO ถ้าเป็นปัญหาแบบถึงกำหนดจะแสดงชุดปัญหาที่ถึงกำหนดออกมา
                if($type != 2 && $type != 3){
               ?>
              
                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-large mr-auto">
                        ปัญหาที่ถึงกำหนด ต้องตอบก่อนถึงจะไปเช็คอินได้
                    </h2>
                </div>
                
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">                    
                            <div class="hidden md:block mx-auto text-gray-600">                    
                                        <!-- BEGIN: Pagination -->
                                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                                            <ul class="pagination">
                                                <li> </li>
                                            </ul>
                                        </div>
                                        <!-- END: Pagination -->                    
                            </div>
                    </div>                    
                    <br>
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">วันเวลาเจอปัญหา</th>
                                    <th class="text-center whitespace-nowrap">ปัญหาที่เจอ</th>
                                    <th class="text-center whitespace-nowrap">คนที่ต้องตาม</th>
                                    <th class="text-center whitespace-nowrap">วันเวลาที่ต้องตาม</th>
                                    <th class="text-center whitespace-nowrap">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($problems as $row){ ?>
                                    <tr>
                                    <td><?php echo $row['Datetime_problem']; ?></td>
                                    <td><?php echo $row['Problem_detail']; ?></td>
                                    <td><?php echo $row['Person_follow']; ?></td>
                                    <td><?php echo $row['Date_follow']; ?></td>
                                    <td>
                                    
                                    <div class="text-center"> 
                                        <div class="dropdown inline-block" data-placement="bottom-start"> 
                                            <button class="dropdown-toggle btn btn-primary" aria-expanded="false"> 
                                                แก้ไขสำเร็จ <i data-feather="chevron-down" class="w-4 h-4 ml-2"></i> 
                                            </button> 
                                            <div class="dropdown-menu"> 
                                                <div class="dropdown-menu__content box p-5"> 
                                                <form action="<?php echo site_url('problem/fixproblem?typefix=1');?>" method="POST">
                                                    <div> 
                                                        <div class="text-xs">ผลการแก้ไข</div> 
                                                            <input required type="text" class="form-control mt-2 flex-1" placeholder="ผลการแก้ไข" name="Problem_result"> 
                                                    </div> 
                                                    <div class="flex items-center mt-3"> 
                                                        <input type="hidden" class="form-control mt-2 flex-1" name="Problem_id" value="<?php echo $row['Problem_id']; ?>">
                                                        <button data-dismiss="dropdown" class="btn btn-secondary w-32 ml-auto">ยกเลิก</button> 
                                                        <button type="submit" class="btn btn-primary w-32 ml-2">ยืนยัน</button> 
                                                    </div> 
                                                </form>
                                                </div> 
                                            </div> 
                                        </div> 
                                    </div> 
                                    <br>
                                    <div class="text-center"> 
                                        <div class="dropdown inline-block" data-placement="bottom-start"> 
                                            <button class="dropdown-toggle btn btn-warning" aria-expanded="false"> 
                                                เลื่อนออกไป <i data-feather="chevron-down" class="w-4 h-4 ml-2"></i> 
                                            </button> 
                                            <div class="dropdown-menu"> 
                                                <div class="dropdown-menu__content box p-5"> 
                                                <form action="<?php echo site_url('problem/postpone?typefix=2');?>" method="POST">
                                                    <div> 
                                                        <div class="text-xs">วันที่เลื่อนออก</div> 
                                                            <input required type="date" class="form-control mt-2 flex-1" name="Date_follow"> 
                                                    </div> 
                                                    <div class="mt-3"> 
                                                        <div class="text-xs">เวลาที่เลื่อนออก</div> 
                                                        <input required type="time" class="form-control mt-2 flex-1" name="Time_follow"> 
                                                    </div> 
                                                    <div class="flex items-center mt-3"> 
                                                        <input type="hidden" class="form-control mt-2 flex-1" name="Problem_id" value="<?php echo $row['Problem_id']; ?>"> 
                                                        <button data-dismiss="dropdown" class="btn btn-secondary w-32 ml-auto">ยกเลิก</button> 
                                                        <button type="submit" class="btn btn-primary w-32 ml-2">ยืนยัน</button> 
                                                    </div> 
                                                </form>
                                                </div> 
                                            </div> 
                                        </div> 
                                    </div> 
                                    
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div> 

                    <?php } ?>
 
                    <?php //TODO ถ้าเป็นปัญหาแบบถึงกำหนดจะแสดงชุดปัญหาที่ถึงกำหนดออกมา
                    if($type == 2){
                    ?>

                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        ปัญหาที่ยังไม่ถึงกำหนด
                    </h2>
                </div>
                
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">                    
                            <div class="hidden md:block mx-auto text-gray-600">                    
                                        <!-- BEGIN: Pagination -->
                                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                                            <ul class="pagination">
                                                <li>  </li>
                                            </ul>
                                        </div>
                                        <!-- END: Pagination -->                    
                            </div>
                    </div>                    
                    <br>
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">วันเวลาเจอปัญหา</th>
                                    <th class="text-center whitespace-nowrap">ปัญหาที่เจอ</th>
                                    <th class="text-center whitespace-nowrap">คนที่ต้องตาม</th>
                                    <th class="text-center whitespace-nowrap">วันเวลาที่ต้องตาม</th>
                                    <th class="text-center whitespace-nowrap">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($problems as $row){ ?>
                                    <tr>
                                    <td><?php echo $row['Datetime_problem']; ?></td>
                                    <td><?php echo $row['Problem_detail']; ?></td>
                                    <td><?php echo $row['Person_follow']; ?></td>
                                    <td><?php echo $row['Date_follow']; ?></td>
                                    <td>
                                                                     
                                    <div class="text-center"> 
                                        <div class="dropdown inline-block" data-placement="bottom-start"> 
                                            <button class="dropdown-toggle btn btn-primary" aria-expanded="false"> 
                                                แก้ไขสำเร็จ <i data-feather="chevron-down" class="w-4 h-4 ml-2"></i> 
                                            </button> 
                                            <div class="dropdown-menu"> 
                                                <div class="dropdown-menu__content box p-5"> 
                                                <form action="<?php echo site_url('problem/fixproblem?typefix=2');?>" method="POST">
                                                    <div> 
                                                        <div class="text-xs">ผลการแก้ไข</div> 
                                                            <input type="text" class="form-control mt-2 flex-1" placeholder="ผลการแก้ไข" name="Problem_result"> 
                                                    </div> 
                                                    <div class="flex items-center mt-3"> 
                                                        <input type="hidden" class="form-control mt-2 flex-1" name="Problem_id" value="<?php echo $row['Problem_id']; ?>"> 
                                                        <button data-dismiss="dropdown" class="btn btn-secondary w-32 ml-auto">ยกเลิก</button> 
                                                        <button type="submit" class="btn btn-primary w-32 ml-2">ยืนยัน</button> 
                                                    </div> 
                                                </form>
                                                </div> 
                                            </div> 
                                        </div> 
                                    </div> 

                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <?php } ?>
 
                    <?php //TODO ถ้าเป็นปัญหาแบบถึงกำหนดจะแสดงชุดปัญหาที่ถึงกำหนดออกมา
                    if($type == 3){
                    ?>

                    
                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        ปัญหาที่แก้แล้ว
                    </h2>
                </div>
                
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">                    
                            <div class="hidden md:block mx-auto text-gray-600">                    
                                        <!-- BEGIN: Pagination -->
                                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                                            <ul class="pagination">
                                                <li> </li>
                                            </ul>
                                        </div>
                                        <!-- END: Pagination -->                    
                            </div>
                    </div>                    
                    <br>
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">วันเวลาเจอปัญหา</th>
                                    <th class="text-center whitespace-nowrap">ปัญหาที่เจอ</th>
                                    <th class="text-center whitespace-nowrap">คนที่ต้องตาม</th>
                                    <th class="text-center whitespace-nowrap">ผลการแก้ไข</th>
                                    <th class="text-center whitespace-nowrap">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($problems as $row){ ?>
                                    <tr>
                                    <td><?php echo $row['Datetime_problem']; ?></td>
                                    <td><?php echo $row['Problem_detail']; ?></td>
                                    <td><?php echo $row['Person_follow']; ?></td>
                                    <td><?php echo $row['Problem_result']; ?></td>
                                    <td><button class='btn btn-success'> แก้ไขแล้ว</button></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <?php } ?>
 