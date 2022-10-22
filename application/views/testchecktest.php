<?php 
    $datetime = new DateTime();
    $timenow = $datetime->format('H:i:s');
 ?>
 
                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        ลงชื่อเข้าและออกของวันที่ : <?php echo $data['Date']; ?>
                    </h2>
                    <?php echo $popup; ?>
                </div>
                <!-- BEGIN: Pricing Layout -->
                <div class="intro-y box flex flex-col lg:flex-row mt-5">
                    <div class="intro-y flex-1 px-5 py-16">
                        <i data-feather="sunrise" class="block w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto"></i> 
                        <div class="text-xl font-medium text-center mt-10">เช็คชื่อช่วงเช้า</div><br><br>                            
                        <?php if($timenow > '08:50:00'){ ?>  
                        
                        <?php if($data['Loginm'] != ''){ // ถ้าเช็คชื่อตอนเช้าไปแล้ว ช่องอันนี้จะออกมา ?>
                            <div class="alert alert-success-soft show flex items-center mb-2" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> เช็คชื่อรอบเช้าแล้ว </div>
                            <input type="text" class="form-control border-theme-9" <?php echo $data['Disabledm']; ?> value="<?php echo $data['Loginm']; ?>" >
                            <br><br>

                            <!-- //TODO  ถ้าไม่มีเช็คชื่อผ่านโทรศัพท์ไม่ต้องแสดงกรอบนี้
                            -->
                            <?php if($data['Time_mobile_reasonm'] != ''){ ?>
                                <textarea disabled type="textarea" class="form-control form-control-user"><?php echo $data['Time_mobile_reasonm']?></textarea>
                            <?php }?>

                            <?php if($data['Problem_detail1'] != ''){ // ถ้า Problem_detail มีค่าแสดงว่ามีปัญหา ให้แสดงชุดนี้ออกมา ?>
                                ปัญหาที่เจอช่วงก่อนช็คชื่อ
                                <select disabled class="form-control" style="width:15%">
                                    <option>มี</option>
                                </select>
                            
                                <br><br>ปัญหาที่เจอ
                                <textarea disabled class="form-control form-control-user"><?php echo $data['Problem_detail1'];?></textarea>
                                    <br><br>ต้องตามกับใคร
                                <input disabled type="text" class="form-control" value="<?php echo $data['Person_follow1'];?>">
                                <br><br>ต้องติดตามอีกครั้งวันที่
                                <input disabled type="date" class="form-control" value="<?php echo $data['Date_follow1'];?>">
                               <br><br>เวลา
                                <input disabled type="time" class="form-control" value="<?php echo $data['Time_follow1'];?>">


                            <?php } ?>
                                
                                <!--
                                    //* เอามาหลอกให้รู้ว่าอันนี้ยังอยู่ ไม่งั้น JS ไม่ทำงาน
                                -->
                                
                                <div id="TypeSeleted1" style="display:none;"></div> 
                                <div id="Select_Type"></div>
                                <!--
                                    //* สิ้นสุดเอามาหลอกให้รู้ว่าอันนี้ยังอยู่ ไม่งั้น JS ไม่ทำงาน
                                -->

                        <?php } else{ ?>     
                        
                    <form action="<?php echo site_url('check?mode=loginm');?>" method="POST">    
                            <input type="text" class="form-control" disabled value="<?php echo date('H:i').' น.'; ?>" >
                            <input type="hidden" name="Time_login" value="<?php echo date('Y-m-d H:i:s'); ?>" >
                            <br><br>

                            ปัญหาที่เจอช่วงก่อนเช็คชื่อ
                            <select class="form-control" style="width:15%" id="Select_Type" name="Problem_check">
                                <option value="ไม่มี">ไม่มี</option>
                                <option value="มี">มี</option>
                            </select>
                            
                            <div id="TypeSeleted1" style="display:none;">
                                <br><br>ปัญหาที่เจอ
                                <textarea class="form-control form-control-user" name="Problem_detail"></textarea>
                                <br><br>ต้องตามกับใคร
                                <input type="text" class="form-control" name="Person_follow">
                                <br><br>ต้องติดตามอีกครั้งวันที่
                                <input type="date" class="form-control" name="Date_follow">
                                <br><br>เวลา
                                <input type="time" class="form-control" name="Time_follow">
                            </div>                            
                            <button type="submit" class="btn btn-rounded-primary py-3 px-4 block mx-auto mt-8">ลงชื่อ</button>
                        <?php } ?>
                    </form>
                        <?php }else{ ?>                                
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                        <div class="alert alert-danger-soft show flex items-center mb-2" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> เช็คชื่อช่วงเช้าได้ตั้งแต่ 08.50 น. เป็นต้นไป </div>
                                </div>
                        <?php } ?>
                    </div>
                    
                    <div class="intro-y border-b border-t lg:border-b-0 lg:border-t-0 flex-1 p-5 lg:border-l lg:border-r border-gray-200 dark:border-dark-5 py-16">
                        <i data-feather="sun" class="block w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto"></i> 
                        <div class="text-xl font-medium text-center mt-10">เช็คชื่อช่วงบ่าย</div><br><br>  
                        
                        <?php if($timenow > '12:50:00'){ ?>
                            <?php if($data['Logina'] != ''){ // ถ้าเช็คชื่อตอนเช้าไปแล้ว ช่องอันนี้จะออกมา ?>    
                                <div class="alert alert-success-soft show flex items-center mb-2" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> เช็คชื่อรอบบ่ายแล้ว </div>
                                <input type="text" class="form-control border-theme-9" <?php echo $data['Disableda']; ?> value="<?php echo $data['Logina']; ?>" >
                                <br><br>      

                                <!-- //TODO  ถ้าไม่มีเช็คชื่อผ่านโทรศัพท์ไม่ต้องแสดงกรอบนี้
                                -->
                                <?php if($data['Time_mobile_reasona'] != ''){ ?>
                                    <textarea disabled type="textarea" class="form-control form-control-user"><?php echo $data['Time_mobile_reasona']?></textarea>
                                <?php } ?>
                                
                                <?php if($data['Problem_detail2'] != ''){ // ถ้า Problem_detail มีค่าแสดงว่ามีปัญหา ให้แสดงชุดนี้ออกมา ?>

                                ปัญหาที่เจอช่วงเช้าถึงเที่ยง
                                <select disabled class="form-control" style="width:15%">
                                    <option>มี</option>
                                </select>
                            
                                <br><br>ปัญหาที่เจอ
                                <textarea disabled class="form-control form-control-user"><?php echo $data['Problem_detail2'];?></textarea>
                                    <br><br>ต้องตามกับใคร
                                <input disabled type="text" class="form-control" value="<?php echo $data['Person_follow2'];?>">
                                <br><br>ต้องติดตามอีกครั้งวันที่
                                <input disabled type="date" class="form-control" value="<?php echo $data['Date_follow2'];?>">
                               <br><br>เวลา
                                <input disabled type="time" class="form-control" value="<?php echo $data['Time_follow2'];?>">

                                
                            <?php } ?>
                                
                                <!--
                                    //* เอามาหลอกให้รู้ว่าอันนี้ยังอยู่ ไม่งั้น JS ไม่ทำงาน
                                -->
                                
                                <div id="TypeSeleted2" style="display:none;"></div> 
                                <div id="Select_Type2"></div>
                                <!--
                                    //* สิ้นสุดเอามาหลอกให้รู้ว่าอันนี้ยังอยู่ ไม่งั้น JS ไม่ทำงาน
                                -->
                            
                            <?php } else{ ?>                                      
                                <form action="<?php echo site_url('check?mode=logina');?>" method="POST">  
                                    <input type="text" class="form-control" disabled value="<?php echo date('H:i').' น.'; ?>" >
                                    <input type="hidden" name="Time_login" value="<?php echo date('Y-m-d H:i:s'); ?>" >                                   
                                
                                ปัญหาที่เจอช่วงเช้าถึงเที่ยง
                                <select class="form-control" style="width:15%" id="Select_Type2" name="Problem_check">
                                    <option value="ไม่มี">ไม่มี</option>
                                    <option value="มี">มี</option>
                                </select>
                                
                                <div id="TypeSeleted2" style="display:none;">
                                    <br>ปัญหาที่เจอ
                                    <textarea class="form-control form-control-user" name="Problem_detail"></textarea>
                                    <br><br>ต้องตามกับใคร
                                    <input type="text" class="form-control" name="Person_follow">
                                    <br><br>ต้องติดตามอีกครั้งวันที่
                                    <input type="date" class="form-control" name="Date_follow">
                                    <br><br>เวลา
                                    <input type="time" class="form-control" name="Time_follow">
                                </div>
                                    <input type="hidden" name="Time_id" value="<?php echo $data['Time_id'];?>">
                                    <button type="submit" class="btn btn-rounded-primary py-3 px-4 block mx-auto mt-8">ลงชื่อ</button>
                            <?php } ?>                              
                                </form>   
                        <?php }else{ ?>                                
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                        <div class="alert alert-danger-soft show flex items-center mb-2" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> เช็คชื่อช่วงบ่ายได้ตั้งแต่ 12.50 น. เป็นต้นไป </div>
                                </div>
                            <?php } ?>
                    </div>
                    <div class="intro-y flex-1 px-5 py-16">
                        <i data-feather="sunset" class="block w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto"></i> 
                        <div class="text-xl font-medium text-center mt-10">เช็คชื่อช่วงเย็น</div><br><br>  
                        <?php if($timenow > '18:00:00'){ ?>
                            <?php if($data['Logout'] != ''){ // ถ้าเช็คชื่อตอนเช้าไปแล้ว ช่องอันนี้จะออกมา ?>    
                                <div class="alert alert-success-soft show flex items-center mb-2" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> เช็คชื่อรอบเย็นแล้ว </div>
                                <input type="text" class="form-control border-theme-9" <?php echo $data['Disableda']; ?> value="<?php echo $data['Logout']; ?>" >
                                <br><br>
                                <textarea disabled type="textarea" name="Time_logout_reason" class="form-control form-control-user"><?php echo $data['Time_logout_reason']?></textarea>
                                
                                <!-- //TODO  ถ้าไม่มีเช็คชื่อผ่านโทรศัพท์ไม่ต้องแสดงกรอบนี้
                                -->
                                <?php if($data['Time_mobile_reasonout'] != ''){ ?>
                                    <br><br><textarea disabled type="textarea" class="form-control form-control-user"><?php echo $data['Time_mobile_reasonout']?></textarea>
                                <?php } ?>

                                <?php if($data['Problem_detail3'] != ''){ // ถ้า Problem_detail มีค่าแสดงว่ามีปัญหา ให้แสดงชุดนี้ออกมา ?>
                                    <br><br>
                                ปัญหาที่เจอช่วงเที่ยงถึงเย็น
                                <select disabled class="form-control" style="width:15%">
                                    <option>มี</option>
                                </select>
                            
                                <br><br>ปัญหาที่เจอ
                                <textarea disabled class="form-control form-control-user"><?php echo $data['Problem_detail3'];?></textarea>
                                    <br><br>ต้องตามกับใคร
                                <input disabled type="text" class="form-control" value="<?php echo $data['Person_follow3'];?>">
                                <br><br>ต้องติดตามอีกครั้งวันที่
                                <input disabled type="date" class="form-control" value="<?php echo $data['Date_follow3'];?>">
                               <br><br>เวลา
                                <input disabled type="time" class="form-control" value="<?php echo $data['Time_follow3'];?>">

                                
                            <?php } ?>
                                
                                <!--
                                    //* เอามาหลอกให้รู้ว่าอันนี้ยังอยู่ ไม่งั้น JS ไม่ทำงาน
                                -->
                                
                                <div id="TypeSeleted3" style="display:none;"></div> 
                                <div id="Select_Type3"></div>
                                <!--
                                    //* สิ้นสุดเอามาหลอกให้รู้ว่าอันนี้ยังอยู่ ไม่งั้น JS ไม่ทำงาน
                                -->

                            <?php } else{ ?>                                      
                                <form action="<?php echo site_url('check?mode=logout');?>" method="POST">  
                                    <input type="text" class="form-control" disabled value="<?php echo date('H:i').' น.'; ?>" >
                                    <input type="hidden" name="Time_logout" value="<?php echo date('Y-m-d H:i:s'); ?>" >
                                    <br><br>
                                    <textarea required type="textarea" name="Time_logout_reason" class="form-control form-control-user">งานที่ทำวันนี้</textarea>
                                    
                                    <br><br>
                                ปัญหาที่เจอช่วงเที่ยงถึงเย็น
                                <select class="form-control" style="width:15%" id="Select_Type3" name="Problem_check">
                                    <option value="ไม่มี">ไม่มี</option>
                                    <option value="มี">มี</option>
                                </select>
                                
                                <div id="TypeSeleted3" style="display:none;">
                                    <br>ปัญหาที่เจอ
                                    <textarea class="form-control form-control-user" name="Problem_detail"></textarea>
                                    <br><br>ต้องตามกับใคร
                                    <input type="text" class="form-control" name="Person_follow">
                                    <br><br>ต้องติดตามอีกครั้งวันที่
                                    <input type="date" class="form-control" name="Date_follow">
                                    <br><br>เวลา
                                    <input type="time" class="form-control" name="Time_follow">
                                </div>
                                    <input type="hidden" name="Time_id" value="<?php echo $data['Time_id'];?>">
                                    <button type="submit" class="btn btn-rounded-primary py-3 px-4 block mx-auto mt-8">ลงชื่อ</button>
                            <?php } ?>                              
                                </form>   
                        <?php }else{ ?>                                
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                        <div class="alert alert-danger-soft show flex items-center mb-2" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> เช็คชื่อช่วงเย็นได้ตั้งแต่ 18.00 น. เป็นต้นไป </div>
                                </div>
                            <?php } ?>
                    </div>
                </div>
                <!-- END: Pricing Layout -->
             

<script>
// สำหรับ Dynamic Selected ของประเภทการเบิก และประเภทงานในหน้าเพิ่มการเบิกจ่าย
    window.onload = function() {
        var eSelect1 = document.getElementById('Select_Type');
        var eSelect2 = document.getElementById('Select_Type2');
        var eSelect3 = document.getElementById('Select_Type3');
        var Box1 = document.getElementById('TypeSeleted1');
        var Box2 = document.getElementById('TypeSeleted2');
        var Box3 = document.getElementById('TypeSeleted3');
         
        eSelect1.onchange = function() {
            if(eSelect1.selectedIndex === 0) {
                Box1.style.display = 'none';
            } 
            if(eSelect1.selectedIndex === 1) {
                Box1.style.display = 'block';
            } 
        }
        eSelect2.onchange = function() {
            if(eSelect2.selectedIndex === 0) {
                Box2.style.display = 'none';
            } 
            if(eSelect2.selectedIndex === 1) {
                Box2.style.display = 'block';
            } 
        }
        eSelect3.onchange = function() {
            if(eSelect3.selectedIndex === 0) {
                Box3.style.display = 'none';
            } 
            if(eSelect3.selectedIndex === 1) {
                Box3.style.display = 'block';
            } 
        }

    }
  
  </script>