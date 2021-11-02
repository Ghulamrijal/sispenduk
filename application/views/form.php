<div class="content-wrapper">
    <section class="content">
        <?php echo alert('alert-info', 'Selamat', 'Data Berhasil Diperbaharui')?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">Syarat & Ketentuan</h3>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

<script type="text/javascript">
    $(function() {
        //autocomplete
        $("#name_user").autocomplete({
            source: "<?php echo base_url()?>/index.php/welcome/autocomplate",
            minLength: 1
        });				
    });
</script>