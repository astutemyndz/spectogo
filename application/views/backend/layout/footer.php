<!--scroll to top-->
<!--<a href="javascript:void(0);" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>-->
</div>
</div>
<script src="<?=base_url('assets/admin/vendor/jquery/jquery-3.4.0.min.js')?>"></script>
<script src="<?=base_url('assets/admin/vendor/bootstrap/js/bootstrap-3.4.0.min.js')?>"></script>
<script src="<?=base_url('assets/admin/vendor/nano-scroller/nano-scroller.js')?>"></script>
<script src="<?=base_url('assets/admin/javascripts/template-script.min.js')?>"></script>
<script src="<?=base_url('assets/admin/javascripts/template-init.min.js')?>"></script>
<script src="<?=base_url('assets/admin/javascripts/template-init.min.js')?>"></script>
<script src="<?=base_url('assets/admin/vendor/toastr/toastr.min.js')?>"></script>
<script src="<?=base_url('assets/admin/vendor/chart-js/chart.min.js')?>"></script>
<script src="<?=base_url('assets/admin/vendor/magnific-popup/jquery.magnific-popup.min.js')?>"></script>
<script src="<?=base_url('assets/admin/vendor/data-table/media/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('assets/admin/vendor/data-table/media/js/dataTables.bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/admin/vendor/data-table/extensions/Responsive/js/dataTables.responsive.min.js')?>"></script>
<script src="<?=base_url('assets/admin/vendor/data-table/extensions/Responsive/js/responsive.bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/admin/javascripts/examples/tables/data-tables.js')?>"></script>
<script src="<?=base_url('assets/js/ckeditor/ckeditor.js')?>"></script>
<script src="<?=base_url('assets/js/sweetalert.min.js')?>"></script>
<script src="<?=base_url('assets/admin/colorpicker/jscolor.js')?>"></script>
<script type="text/javascript">
    function cookie_del() {
        var exdays = 5;
        var cname = 'usercookie';
        var cvalue = 0;
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function cookie_create(cvalue) {
        var exdays = 5;
        var cname = 'usercookie';
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        //alert(cname + "=" + cvalue + ";" + expires + ";path=/");
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    var base_url = '<?=base_url()?>';

</script>
<script src="<?=base_url('assets/admin/custom-admin-dev.js')?>"></script>
</body>

</html>
