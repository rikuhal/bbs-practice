<?php
App::uses('AppModel','Model');
class User extends AppModel{
    public $validate=array(//入力チェックを設定
        'username'=>array(//ユーザーネームに対して入力チェックを設定
            'notEmpty'=>array(
                'rule'=>array('notEmpty'),//入力チェックのルールは「入力必須」にする
                'message'=>'ユーザーネームを入力してください。',//表示するエラーメッセージを設定
            ),
        ),
        'password'=>array(
            'notEmpty'=>array(
                'rule'=>array('notEmpty'),
                'message'=>'パスワードを入力してください。',
            ),
        ),
    );
    public function beforeSave($options=array()){
        $this->data['User']['password']=AuthComponent::password($this->data['User']['password']);//パスワードを暗号化する。
        return true;
    }
}
?>
