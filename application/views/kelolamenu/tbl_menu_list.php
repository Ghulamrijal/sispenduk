<div class="content-wrapper">
    <section class="content">

    <div class="konten">
			<h1 align="center" class="site-heading text-center text-white d-none d-lg-block">
                <span class="site-heading-upper text-primary mb-3">Pemerintah Kota Batu</span>
                <br>
	   			<span class="site-heading-lower">DINAS KEPENDUDUKAN DAN CATATAN SIPIL</span>
	  	 	</h1>
			<br/>
		</div>	
        <div class="col-xl-9 col-lg-10 mx-auto">
              <div class="bg-faded rounded p-5">
                <h2 class="section-heading mb-4">
                  <span class="section-heading-upper">MAKLUMAT</span>
                </h2>
                <h3> Dengan ini, Kami Menyatakan
                    Sanggup Menyelenggarakan Pelayanan Sesuai Standar Pelayanan 
                    Yang Telah ditetapkan, Demi Peningkatan Kualitas Pelayanan Kepada Masyarakat
                    Dan Siap Menerima Sanksi Jika Melanggar Standar Pelayanan</h3>
              </div>
    </section>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $("#mytable").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "kelolamenu/json", "type": "POST"},
            columns: [
                {
                    "data": "id_menu",
                    "orderable": false
                },{"data": "title"},{"data": "url"},{"data": "icon"},{"data": "is_main_menu"},{"data": "is_aktif"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>