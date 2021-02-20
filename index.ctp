<?php
//タイトルを変更。assign()の第一引数はfetch()の引数と合わせる。第二引数にページタイトルを記述。
$this->assign('title', '記事投稿');
?>
<table>
<tr><th>ID</th><th>タイトル</th><th>本文</th><th>作成者</th><th>操作</th><th>status</th>
</tr>
<tr>
<?php foreach ((array)$posts as $post){ ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td><?php echo $this->Html->link($post['Post']['title'],array('action'=>'view',$post['Post']['id'])); ?></td>
        
        <td><?php echo $post['Post']['body']; ?></td>
        <td><?php echo $post['Post']['writer']; ?></td>
        <td><?php echo $this->Html->link(__('編集'),array('action'=>'edit',$post['Post']['id'])); ?>
            <?php echo $this->Form->postLink(__('削除'),array('action'=>'delete',$post['Post']['id']),
                array('confirm'=>__('削除してよろしいですか？'))); ?></td>
        <td><?php echo $post['Post']['status']; ?></td>
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
