<!-- Layout -->
<?=$this->layout('member::layout')?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="page-header">
            <h3><i class="fa fa-pencil"></i>Tambah Users</h3>
        </div>
        <!-- End Page Header -->
        <div class="member-content">
            <!-- Form -->
            <?=$this->form()->formStart(array('method' => 'post', 'action' => BASE_URL.'/member/user/addnew', 'autocomplete' => 'off'));?>
                <div class="row">
                    <!-- input username -->
                    <div class="col-md-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Username', 'name' => 'username', 'id' => 'username', 'mandatory' => true, 'options' => 'required'));?>
                    </div>
                    <!-- Nama Lengkap -->
                    <div class="col-md-6">
                        <?=$this->form()->inputText(array('type' => 'text', 'label' => 'Nama Lengkap', 'name' => 'nama_lengkap', 'id' => 'nama_lengkap', 'mandatory' => true, 'options' => 'required'));?>
                    </div>
                </div>
                <div class="row">
                    <!-- Password -->
                    <div class="col-md-6">
                        <?=$this->form()->inputText(array('type' => 'password', 'label' => 'Password', 'name' => 'password', 'id' => 'password', 'mandatory' => true, 'options' => 'required'));?>
                    </div>
                    <!-- Ulangi password -->
                    <div class="col-md-6">
                        <?=$this->form()->inputText(array('type' => 'password', 'label' => 'Ulangi Password', 'name' => 'repeatpass', 'id' => 'repeatpass', 'mandatory' => true, 'options' => 'required'));?>
                    </div>
                    <!-- Selectbox level user -->
                    <div class="col-md-12">
                        <?php
                        $item = array();
                        $levels = $this->core()->call->db->from('user_level')->orderBy('id_level ASC')->fetchAll();
                        foreach($levels as $level){
                            $item[] = array('value' => $level['id_level'], 'title' => $level['title']);
                        }
                        ?>
                        <?=$this->form()->inputSelect(array('id' => 'level', 'label' => 'Level', 'name' => 'level', 'mandatory' => true), $item);?>
                    </div>
                </div>
                <div class="row">
                    <!-- Submit -->
                    <div class="col-md-12">
                        <?=$this->form()->formAction();?>
                    </div>
                </div>
            <?=$this->form()->formEnd();?>
        </div>
    </div>
</div>