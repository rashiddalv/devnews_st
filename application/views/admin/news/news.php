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
                            <th>Başlıq</th>
                            <!-- <th>Description</th> -->
                            <th>Təsvir</th>
                            <th>Kateqoriya</th>
                            <th>Yaradıcının adı</th>
                            <th>Şəkil</th>
                            <th>Vəziyyət</th>
                            <th>Parametrlər</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($get_all_news as $item) { ?>
                            <tr>
                                <td><?php 
                                //Trimming text to a specific length
                                $title = substr($item['n_title'], 0, 30);
                                //Then make sure the text doesn't end with an exclamation mark, comma, period, or dash
                                $title = rtrim($title, "!,.-");
                                //Finally, we find the last space, eliminate it and put "..."
                                $title = substr($title, 0, strrpos($title, ' '));
                                echo $title."..." ?></td>


                                <td><?php echo date("d.m.Y", strtotime($item['n_date'])); ?></td>
                                <td><?php echo $item['n_category'] ?></td>
                                <td><?php echo $item['a_name'] ?></td>
                                <td>
                                    <?php if ($item['n_img']) { ?>
                                        <img width="70" height="70" style="object-fit: cover;" src="<?php echo base_url('uploads/news/' . $item['n_img']) ?> " alt="">
                                    <?php } else { ?>
                                        <img width="70" height="70" style="object-fit: cover;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png" alt="">
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($item['n_status'] == "Active") { ?>
                                        <span class="badge bg-label-success me-1"><?php echo $item['n_status'] ?></span>

                                    <?php   } else if ($item['n_status'] == "Deactive") { ?>
                                        <span class="badge bg-label-danger me-1"><?php echo $item['n_status'] ?></span>

                                    <?php } else { ?>
                                        <span class="badge bg-label-primary me-1">error</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-info">Detail</button>
                                    <button type="button" class="btn btn-sm btn-outline-warning">Edit</button>
                                    <a href="<?php echo base_url('admin_news_delete/' . $item['n_id']); ?>">
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