<!-- Layout -->
<?=$this->layout('site::layout')?>

<!-- Content -->
<div class="flex-center position-ref full-height">          
    <div class="content">
        <div class="title m-b-md">
            <?=CONF_STRUCTURE;?> <?=CONF_VER;?>.<?=CONF_BUILD;?>            
        </div>
        <div class="links">
            <a href="javascript:void(0);" title="Hak Akses Khusus Team Racikproject">
                Power by Racikproject | Top Digital Solution | <?=CONF_RELEASE?>
            </a>
        </div>
    </div>
</div>

<!-- Add script -->
<?php $this->push('scripts') ?>
    <script>
        // Some JavaScript
        console.log('Hallo Racikproject');
    </script>
<?php $this->end() ?>