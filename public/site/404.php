<!-- Layout -->
<?=$this->layout('site::layout')?>

<!-- Content -->
<div class="flex-center position-ref full-height">          
    <div class="content">
        <div class="title m-b-md">
            Page Not Found     
        </div>
        <h3>Error 404</h3>
        <p>
            The page you requested could not be found, either contact your webmaster or try again.<br />
            Use your browsers <b>Back</b> button to navigate to the page you have previously<br />
            come from <b>or you could just press this neat little button :</b>
        </p>
        <div class="links">
            <a href="<?=BASE_URL?>" class="btn btn-sm btn-primary"><i class="fa fa-home"></i> Take Me Home</a>
        </div>
    </div>
</div>