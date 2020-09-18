<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">Welcome <?= $user->first_name." ". $user->last_name; ?></h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="<?=base_url('home/user');?>">List Users</a>
        <a class="p-2 text-dark" href="<?=base_url('home/country');?>">List Countries</a>
    </nav>
    <a class="btn btn-outline-primary" href="<?= base_url('home/logout') ?>">Log Out</a>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
        </div>
    </div>
    <div class="row login-form">
        <div class="col-lg-12 center">
            <table id="countries_table" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Alpha2 Code</th>
                        <th>Alpha3 Code</th>
                        <th>Calling Code</th>
                        <th>Demonym</th>
                        <th>Flag</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <br>
        </div>
    </div>
</div>
<script>
    var country_ajax_url = "<?= base_url('home/ajax_country'); ?>";
</script>