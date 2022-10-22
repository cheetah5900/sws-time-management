                <div class="intro-y flex items-center mt-8" style="float:left;">                
                    <h2 class="text-lg font-medium mr-auto">
                    สรุปผลประจำวันที่ :                     
                    </h2>
                               
                    <form action="conclude" method="GET">
                    <input type="text" class="datepicker pl-12" name="Datepick" data-single-mode="true" value=" <?php echo $date ?>"> 
                    <input type="hidden" name="filter" value="filtdate"> 
                    </form>
                    <br><br><br><br><br><br>
                </div>               
                
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                            <th width="250px"><span class="text-xl">ชื่อแผนก</span></th>
                                            <th><span class="text-xl">สรุปงาน</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($concludes as $row){ ?>
                                <tr>
                                    <td><?php echo $row['Department']; ?></td>
                                    <td><?php echo $row['Review_detail']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <!-- END: Pricing Layout -->
            </div>
            <!-- END: Content -->
        </div>