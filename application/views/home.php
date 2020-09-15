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
    <h5 class="my-0 mr-md-auto font-weight-normal">Welcome <?= $user->username; ?></h5>
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
                    <label>Username</label>
                    <input type="text" name="username" value="<?=$user->username;?>" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Bio</label>
                    <textarea name="about" class="form-control" placeholder="I am a.." required><?=$user->about;?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>
