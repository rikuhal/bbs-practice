<?php
	echo $this->Form->create('Post');
	echo $this->Form->input('id');
	echo $this->Form->input('title');
	echo $this->Form->input('body');
	echo $this->Form->input('writer');
	echo $this->Form->input('status');
	echo $this->Form->end('送信');
?>
