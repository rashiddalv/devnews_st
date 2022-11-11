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
        <h5 class="card-header spaceB">Messages List
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
                            <th>#</th>
                            <th>Description</th>
                            <!-- <th>Description</th> -->
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Parametrlər</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <?php $messages_amount = 0;
                            foreach ($get_all_messages as $item) {
                                $messages_amount++ ?>
                        <tr>
                            <td><?php echo $messages_amount; ?></td>
                            <td><?php
                                //Trimming text to a specific length
                                // $title = substr($item['n_title'], 0, 30);
                                // //Then make sure the text doesn't end with an exclamation mark, comma, period, or dash
                                // $title = rtrim($title, "!,.-");
                                // //Finally, we find the last space, eliminate it and put "..."
                                // $title = substr($title, 0, strrpos($title, ' '));
                                // echo $title . "..." 
                                echo $item['u_subject'] ?></td>
                            <td><?php echo $item['u_subject']; ?></td>
                            <td><?php echo $item['u_name'] ?></td>
                            <td><?php echo $item['u_email'] ?></td>

                            <td>
                                <a href="">
                                    <button type="button" class="btn btn-sm btn-outline-info">Detail</button>
                                </a>

                                <a href="">
                                    <button type="button" class="btn btn-sm btn-outline-warning">Edit</button>
                                </a>

                                <a href="">
                                    <button onclick="return confirm('Xəbəri silmək istədiyinizə əminsiniz?')" type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Bordered Table -->
</div>


<?php $this->load->view('admin/includes/footer'); ?>
<?php $this->load->view('admin/includes/footerStyle'); ?>