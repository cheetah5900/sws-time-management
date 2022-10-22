<div class="flex items-center mt-8">
                    <h2 class="intro-y text-lg font-medium mr-auto">
                        ลางาน
                    </h2>
                </div>
                <!-- BEGIN: Wizard Layout -->
                <div class="intro-y box py-10 sm:py-20 mt-5">
                    <div class="wizard flex flex-col lg:flex-row justify-center px-5 sm:px-20">
                        <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                            <button class="w-10 h-10 rounded-full btn btn-primary">1</button>
                            <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Create New Account</div>
                        </div>
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <button class="w-10 h-10 rounded-full btn text-gray-600 bg-gray-200 dark:bg-dark-1">2</button>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">Setup Your Profile</div>
                        </div>
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <button class="w-10 h-10 rounded-full btn text-gray-600 bg-gray-200 dark:bg-dark-1">3</button>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">Setup Your Business Details</div>
                        </div>
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <button class="w-10 h-10 rounded-full btn text-gray-600 bg-gray-200 dark:bg-dark-1">4</button>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">Setup Billing Account</div>
                        </div>
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <button class="w-10 h-10 rounded-full btn text-gray-600 bg-gray-200 dark:bg-dark-1">5</button>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">Finalize your purchase</div>
                        </div>
                        <div class="wizard__line hidden lg:block w-2/3 bg-gray-200 dark:bg-dark-1 absolute mt-5"></div>
                    </div>
                    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="font-medium text-base">Profile Settings</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-1" class="form-label">From</label>
                                <input id="input-wizard-1" type="text" class="form-control" placeholder="example@gmail.com">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-2" class="form-label">To</label>
                                <input id="input-wizard-2" type="text" class="form-control" placeholder="example@gmail.com">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-3" class="form-label">Subject</label>
                                <input id="input-wizard-3" type="text" class="form-control" placeholder="Important Meeting">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-4" class="form-label">Has the Words</label>
                                <input id="input-wizard-4" type="text" class="form-control" placeholder="Job, Work, Documentation">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-5" class="form-label">Doesn't Have</label>
                                <input id="input-wizard-5" type="text" class="form-control" placeholder="Job, Work, Documentation">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-6" class="form-label">Size</label>
                                <select id="input-wizard-6" class="form-select">
                                    <option>10</option>
                                    <option>25</option>
                                    <option>35</option>
                                    <option>50</option>
                                </select>
                            </div>
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-secondary w-24">Previous</button>
                                <button class="btn btn-primary w-24 ml-2">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Wizard Layout -->
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
                                    <th class="whitespace-nowrap">วันที่</th>
                                    <th class="text-center whitespace-nowrap" width="10%">เวลาเช็คชื่อ</th>
                                    <th class="text-center whitespace-nowrap">สรุปงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($checks as $row){ ?>
                                    <tr>
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