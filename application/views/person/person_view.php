                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">ข้อมูลพนักงาน</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-4">
                            <div class="m-0 font-weight-bold text-primary pull-left">รายชื่อพนักงาน</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
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
                                        <?php foreach ($persons as $row){ ?>
                                        <tr>
                                            <td><?php echo $row['no']; ?></td>
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
                                                    <span class="icon"><i class="far fa-edit"></i></span>
                                                </a>
                                                <a class="btn btn-danger" onclick="return confirm('ยืนยันลบใช่หรือไม่');" href="<?php echo site_url('person?mode=del&id=').$row['Person_id']; ?>">
                                                    <span class="icon"><i class="fas fa-trash"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            <!-- End of Main Content -->
