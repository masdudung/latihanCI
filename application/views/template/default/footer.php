<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?= base_url('assets/bootstraps/jquery-3.5.1.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstraps/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstraps/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstraps/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/datatables/jquery.dataTables.min.js') ?>"></script>
<?php
if (isset($customjs)) {
    $file = base_url("assets/js/$customjs");
    echo "<script src='$file'></script>";
}
?>
</body>

</html>