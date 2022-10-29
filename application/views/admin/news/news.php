<?php $this->load->view('admin/includes/headerStyle'); ?>
<?php $this->load->view('admin/includes/leftMenu'); ?>
<?php $this->load->view('admin/includes/navbar'); ?>

<style>
    .spaceB {
        display: flex;
        justify-content: space-between;
    }
</style>
<div class="content_r">
    <div class="card">
        <h5 class="card-header spaceB">News List
            <a href="<?php echo base_url('admin_news_create') ?>">
                <button type="button" class="btn  btn-sm btn-success">Create</button>
            </a>
        </h5>

        
        <div class="card-body">
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                </div>
    
            <?php } ?>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <!-- <th>Description</th> -->
                            <th>Date</th>
                            <th>Category</th>
                            <th>Creator name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Php Lesson
                            </td>
                            <td>10.01.2022</td>
                            <td>Education</td>
                            <td>Rashid</td>
                            <td>
                                <img src="" alt="">
                            </td>
                            <td>
                                <span class="badge bg-label-success me-1">Active</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-info">Detail</button>
                                <button type="button" class="btn btn-sm btn-outline-warning">Edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Php Lesson2
                            </td>
                            <td>10.01.2022</td>
                            <td>Education</td>
                            <td>Rashid</td>
                            <td>
                                <img src="" alt="">
                            </td>

                            <td>
                                <span class="badge bg-label-danger me-1">Deactive</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-info">Detail</button>
                                <button type="button" class="btn btn-sm btn-outline-warning">Edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Php Lesson3
                            </td>
                            <td>10.01.2022</td>
                            <td>Education</td>
                            <td>Rashid</td>
                            <td>
                                <img src="" alt="">
                            </td>

                            <td>
                                <span class="badge bg-label-success me-1">Active</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-info">Detail</button>
                                <button type="button" class="btn btn-sm btn-outline-warning">Edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Bordered Table -->
</div>


<?php $this->load->view('admin/includes/footer'); ?>
<?php $this->load->view('admin/includes/footerStyle'); ?>