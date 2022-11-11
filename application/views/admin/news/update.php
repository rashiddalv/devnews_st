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

        <h5 class="card-header spaceB">News Edit
            <a href="<?php echo base_url('admin_news') ?>">
                <button type="button" class="btn  btn-sm btn-danger">Back</button>
            </a>
        </h5>


        <div class="card-body">

            <?php if ($this->session->userdata('err')) { ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <?php echo $this->session->flashdata('err'); ?>
                    </div>
                </div>
            <?php } ?>

            <?php if ($this->session->userdata('success')) { ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                </div>
            <?php } ?>

            <form action="<?php echo base_url('admin_news_update_act/' . $get_single_data['n_id']); ?>" method="post" enctype="multipart/form-data">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo $get_single_data['n_title']; ?>">
                <br>

                <label for="descr">Description</label>
                <textarea name="description" class="form-control" id="descr" cols="30" rows="10"><?php echo $get_single_data['n_description']; ?></textarea>
                <br>

                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left;">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo $get_single_data['n_date']; ?>">
                </div>

                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left; margin:0px 10px">
                    <label for="cate">Category</label>
                    <select name="category" id="cate" class="form-control">
                        <option value="">-SELECT-</option>
                        <?php foreach ($get_all_categories as $item) { ?>
                            <option <?php if ($item['c_name'] == $get_single_data['n_category']) {
                                        echo "SELECTED";
                                    } ?> value="<?php echo $item['c_name']; ?>"><?php echo $item['c_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left; margin:0px 10px">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option <?php if ($get_single_data['n_status'] == "") {
                                    echo "SELECTED";
                                } ?> value="">-SELECT-</option>
                        <option <?php if ($get_single_data['n_status'] == "Active") {
                                    echo "SELECTED";
                                } ?> value="Active">Active</option>
                        <option <?php if ($get_single_data['n_status'] == "Deactive") {
                                    echo "SELECTED";
                                } ?> value="Deactive">Deactive</option>
                    </select>
                </div>


                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left; margin:0px">
                    <label for="img">IMG</label>
                    <input type="file" id="img" class="form-control" name="user_img">
                </div>

                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left; margin:0px">
                    <br>
                    <?php if ($get_single_data['n_img']) { ?>
                        <?php if ($get_single_data['n_file_ext'] == ".pdf") { ?>
                            <img width="100%" style="object-fit: cover;" src="https://media.istockphoto.com/vectors/icon-major-file-format-vector-icon-illustration-vector-id1298834280?k=20&m=1298834280&s=612x612&w=0&h=SxEbyHKi18H1XpPpKKzoppWgMM3x0tc3veN5e6wl7Y8=" alt="">

                        <?php } else { ?>
                            <img width="100%" style="object-fit: cover;" src="<?php echo base_url('uploads/news/' . $get_single_data['n_img']); ?>" alt="">

                            <a href="<?php echo base_url('admin_news_img_delete/' . $get_single_data['n_id']); ?>">
                                <br>
                                <button onclick="return confirm('Məlumatı silmək istədiyinizə əminsiniz?')" type="button" class="btn btn-danger">Delete img</button>
                            </a>


                        <?php } ?>
                    <?php } else { ?>
                        <img width="100%" style="object-fit: cover;" src="https://media.istockphoto.com/vectors/default-image-icon-vector-missing-picture-page-for-website-design-or-vector-id1357365823?k=20&m=1357365823&s=612x612&w=0&h=ZH0MQpeUoSHM3G2AWzc8KkGYRg4uP_kuu0Za8GFxdFc=" alt="">
                    <?php } ?>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="float: left; margin:0px">
                    <br>
                    <button type="submit" class="btn btn-success" style="float: right;">SEND</button>
                </div>


            </form>



        </div>
    </div>
    <!--/ Bordered Table -->
</div>


<?php $this->load->view('admin/includes/footer'); ?>
<?php $this->load->view('admin/includes/footerStyle'); ?>