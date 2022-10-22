                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">สรุปผลประจำวันที่ : <?php echo $date ?></h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="150px">ชื่อแผนก</th>
                                            <th>สรุปงาน</th>
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
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            <!-- End of Main Content -->
