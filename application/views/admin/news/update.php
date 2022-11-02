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
        <h5 class="card-header spaceB">Xəbər Yaradın
            <a href="<?php echo base_url('admin_news') ?>">
                <button type="button" class="btn  btn-sm btn-danger">Geri</button>
            </a>
        </h5>


        <div class="card-body">
            <?php if ($this->session->flashdata('err')) { ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <?php echo $this->session->flashdata('err'); ?>
                    </div>
                </div>

            <?php } ?>
            <form action="<?php echo base_url('admin_news_create_act'); ?>" method="post" enctype="multipart/form-data">
                <label for="title">Başlıq</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo $update_news['n_title']; ?>">
                <br>
                <label for="descr">Təsvir</label>
                <textarea name="description" class="form-control" id="descr" cols="30" rows="10"><?php echo $update_news['n_description']; ?></textarea>
                <br>

                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left;">
                    <label for="date">Tarix</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo $update_news['n_date']; ?>">
                </div>



                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left; margin:0px 10px">
                    <label for="cate">Kateqoriya</label>
                    <select name="category" id="cate" class="form-control">
                        <option value="">-SELECT-</option>
                        <option value="Sport">Sport</option>
                        <option value="Education">Education</option>
                        <option value="Finance">Finance</option>
                    </select>
                </div>


                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left; margin:0px 10px">
                    <label for="status">Vəziyyət</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">-SELECT-</option>
                        <option value="Active">Active</option>
                        <option value="Deactive">Deactive</option>
                    </select>
                </div>


                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="float: left; margin:0px">
                    <label for="img">Şəkil</label>
                    <input type="file" id="img" class="form-control" name="news_img">
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="float: left; margin:0px">
                    <br>
                    <button type="submit" class="btn btn-success" style="float: right;">GÖNDƏR</button>
                </div>


            </form>
        </div>
    </div>
    <!--/ Bordered Table -->
</div>


<?php $this->load->view('admin/includes/footer'); ?>
<?php $this->load->view('admin/includes/footerStyle'); ?>