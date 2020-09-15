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

<div class="container">
    <div class="row">
        <div class="col-lg-12">
        </div>
    </div>
    <div class="row login-form">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 center">
            <?=$notify_html;?>
            <form method="POST" action="<?=base_url('login/auth')?>">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="masdudung" class="form-control" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" value="IkanTeriMasukAngin" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>