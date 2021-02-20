<?php
//タイトルを変更。assign()の第一引数はfetch()の引数と合わせる。第二引数にページタイトルを記述。
$this->assign('title', 'あなたの記事一覧');
?>
<table>
<tr><th>ID</th><th>タイトル</th><th>投稿内容</th><th>作成日</th>
</tr>
<tr>
<?php foreach ((array)$data as $post){ ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td><?php echo $post['Post']['title']; ?></td>
        <td><?php echo $post['Post']['body']; ?></td>
        <td><?php echo $post['Post']['created']; ?></td>
    </tr>
<?php }?>

</tr>
</table>
<div class="paging">
<?php
echo $this->Paginator->prev('< '.__('previous'),array(),null,array('class'=>'prev disabled'));
echo $this->Paginator->numbers(array('separator'=> ''));
echo $this->Paginator->next(__('next') .'>',array(),null,array('class'=>'next disabled'));
?>
</div>
<?php /* debug($auth);  */?>
<?php /* debug($data); */?>
<?php /*debug($user_id); */?>
