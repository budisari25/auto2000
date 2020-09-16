<!-- Layout -->
<?=$this->layout('member::layout')?>

<div class="row justify-content-center">
    <div class="col-12">
        <div class="page-header">
            <h3><i class="fa fa-pencil"></i>Edit Users</h3>
        </div>
        <!-- End Page Header -->
        <div class="member-content pt-5">
            <?=$this->form()->formStart(array('method' => 'POST', 'action' => BASE_URL.'/member/mana/user/edit/'.$user['id_user'], 'autocomplete' => 'off'));?>
                <?=$this->form()->inputHidden(array('name' => 'id', 'value' => $user['id_user']));?>
                <div class="row">
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Username', 'name' => 'username', 'value'=> $user['username'], 'mandatory' => true, 'options' => 'disabled'));?>
                    </div>
                    <div class="col-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Full Name', 'name' => 'nama_lengkap', 'value'=> $user['nama_lengkap'], 'mandatory' => true, 'options' => ''));?>
                    </div>
                </div>
                <div class="row">                
                    <div class="col-12">
                        <div class="md-form">
                            <select class="mdb-select" id="ket" name="ket">
                                <option value="<?=strtolower($user['level'])?>" selected><?=$user['title']?></option>
                                <option value="9">Sales</option>
                                <option value="5">SA</option>
                                <option value="8">MRA</option>
                            </select>
                            <label for="jenis">Devisi <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-12">
                        <?=$this->form()->formAction();?>
                    </div>
                </div>
            <?=$this->form()->formEnd();?>
        </div>
        <!-- End Member content -->
    </div>
    <!-- End col-10 -->
</div>