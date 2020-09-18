<?php
$notify_html = '';
$notify = $this->session->flashdata('notify');
if($notify)
{
    $type = 'success';
    if($notify['error']==true)
        $type = 'danger';

    $notify_html = '<div class="alert alert-'.$type.'" role="alert">'.$notify['message'].'</div>';
}
?>

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
        <div class="col-lg-2"></div>
        <div class="col-lg-8 center">
            <?=$notify_html;?>
            <form method="POST" action="<?=base_url('home/profileUpdate')?>">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="username" value="<?=$user->email;?>" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Bio</label>
                    <textarea name="phone_number" class="form-control" placeholder="I am a.." required><?=$user->phone_number;?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>
