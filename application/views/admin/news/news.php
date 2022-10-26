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
        <h5 class="card-header spaceB">News List <button type="button" class="btn  btn-sm btn-success">Create</button></h5>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <!-- <th>Description</th> -->
                            <th>Date</th>
                            <th>Category</th>
                            <th>Creator name</th>
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