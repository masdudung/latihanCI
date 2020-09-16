<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">Welcome <?= $user->username; ?></h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="<?= base_url('home/user'); ?>">List Users</a>
        <a class="p-2 text-dark" href="<?= base_url('home/country'); ?>">List Countries</a>
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
            <table id="users_table" class="display">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Gender</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($users) {
                        foreach ($users as $key => $item) {
                            # code...
                    ?>
                    <tr>
                        <td><?= "$item->first_name $item->last_name"; ?></td>
                        <td><?= $item->email; ?></td>
                        <td><?= $item->phone_number; ?></td>
                        <td><?= $item->gender; ?></td>
                        <td><?= $item->name; ?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>
</div>