<!-- Layout -->
<?=$this->layout('member::layout')?>

<div id="alertmsg"></div>

<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h3><i class="fa fa-pencil"></i>Pilih Forman</h3>
        </div>
        <!-- End Page Header -->
        <div class="member-content">                  
            <?=$this->form()->formStart(array('method' => 'POST', 'action' => BASE_URL.'/member/o/toforman/'.$idtracker, 'autocomplete' => 'off'));?>
            <div class="row">
                <div class="col-md-12">
                    <?php
                        $item = array();
                        $menus = $this->core()->call->db->from('users')
                            ->where('level', 3)
                            ->where('company', $user_member['id_user'])
                            ->orderBy('id_user ASC')
                            ->fetchAll();
                        foreach($menus as $menu){
                            $item[] = array('value' => $menu['id_user'], 'title' => $menu['nama_lengkap']);
                        }
                    ?>
                    <?=$this->form()->inputSelect(array('id' => 'kelompok', 'label' => 'Pilih Kelompok', 'name' => 'kelompok', 'mandatory' => true), $item);?>
                </div>
            </div>  
            <?=$this->form()->formAction();?>
            <?=$this->form()->formEnd();?>
        </div>
        <!-- End Member content -->
    </div>
    <!-- End col-md-10 -->
</div>

<!-- Add script -->
<?php $this->push('scripts') ?>
<?php $this->end() ?>