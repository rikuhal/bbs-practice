<h2><?php echo h($post['Post']['title']); ?></h2>
<p><?php echo nl2br(h($post['Post']['body'])); ?></p>
作成日時:<?php echo h($post['Post']['created']); ?><br/>
最終編集日時:<?php echo h($post['Post']['modified']); ?><br/>
作成者:<?php echo h($post['Post']['writer']); ?><br/>
状態:<?php
$status = array(0=>'公開',1=>'非公開');//statusと言う名前の以下の連想配列を作成。[0]=>公開、[1]=>非公開
echo $status[$post['Post']['status']];//作成したstatus配列のキーが0の値を取得
?><br/>
<?php echo $this->Html->link(__('編集'),array('action'=>'edit',$post['Post']['id'])); ?> |
<?php echo $this->Form->postLink(__('削除'),array('action'=>'delete',$post['Post']['id']),
	array('confirm'=>__('削除してよろしいですか?'))); ?><br/>
<?php echo $this->Html->link(__('一覧へ戻る'),array('action'=>'index',$post['Post']['id'])); ?><br/>
<?php $this->log($post, LOG_DEBUG); ?>  
<br/>
<h3>コメント一覧</h3><br/>

<table>
<?php
$comments =$post['Comment'];
foreach ((array)$comments as $comment){ ?>
	<tr>
		<td><?php if(isset($comment['comment'])){
			echo $comment['comment'];
		} 
		?><br/>
		posted by <?php if(isset($comment['name'])){
			echo $comment['name'];
		}
		?>
		at <?php if(isset($comment['created'])){
		echo $comment['created'];
		}
		?>
		</td>
	</tr>

<?php }?>
</table>
<h3>コメントを投稿する</h3>
<br/>
<?php 
echo $this->Form->create('Comment',array('url'=>array('comments'=>'controller','action'=>'add',)));
echo $this->Form->input('name',['label'=>'名前']);
echo $this->Form->hidden('post_id', array('value'=>$post['Post']['id']));
echo $this->Form->input('comment',['label'=>'コメント']);
echo $this->Form->end('コメントを投稿する');
?>
