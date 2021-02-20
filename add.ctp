<?php
echo $this->Form->create('Post',array('novalidate'=>true));//<Form>タグを出力する、
//HTML5でブラウザで実行される入力必須チェックが無効になる
echo $this->Form->input('title');//タイトルを入力する入力ボックスを表示
echo $this->Form->input('body');//本文を入力する入力ボックスを表示
echo $this->Form->input('writer');
echo $this->Form->hidden('user_id', array('value'=>$auth['id']));
echo $this->Form->end('投稿する');//</form>タグとsubmitボタンを出力
?>
<?php
//タイトルを変更。assign()の第一引数はfetch()の引数と合わせる。第二引数にページタイトルを記述。
$this->assign('title', '投稿画面');
?>
<?php /* debug($auth); */?>
