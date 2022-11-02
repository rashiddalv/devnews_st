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

        <h5 class="card-header spaceB">News Detail
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

            <form action="<?php echo base_url('admin_news_create_act'); ?>" method="post" enctype="multipart/form-data">
                <label for="title"><b>Title</b></label>
                <p><?php echo $single_news['n_title']; ?></p>
                <br>

                <label for="descr"><b>Description</b></label>
                <p><?php echo $single_news['n_description']; ?></p>


                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left;">
                    <label for="date"><b>Date</b></label>
                    <p><?php echo $single_news['n_date']; ?></p>
                </div>



                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left; margin:0px 10px">
                    <label for="cate"><b>Category</b></label>
                    <p><?php echo $single_news['n_category']; ?></p>
                </div>


                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left; margin:0px 10px">
                    <label for="status"><b>Status</b></label>
                    <p><?php echo $single_news['n_status']; ?></p>
                </div>

                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left; margin:0px 10px">
                    <label for="status"><b>Creator</b></label>
                    <p><?php echo $single_news['a_name']; ?></p>
                </div>

                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="float: left; margin:0px 10px">

                    <?php if ($single_news['n_updater_id'] != 0) { ?>
                        <label for="status"><b>Updater</b></label>
                        <p><?php echo $single_news['n_updater_id']; ?></p>
                    <?php } else { ?>
                        <label for="status"><b>Updater</b></label>
                        <p>-</p>
                    <?php } ?>

                </div>


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="float: left; margin:0px">
                    <label for="img"><b>File</b></label>
                    <br>
                    <img width="150" src="<?php echo base_url('uploads/news/' . $single_news['n_img']); ?>" alt="">
                </div>





            </form>



        </div>
    </div>
    <!--/ Bordered Table -->
</div>


<?php $this->load->view('admin/includes/footer'); ?>
<?php $this->load->view('admin/includes/footerStyle'); ?>