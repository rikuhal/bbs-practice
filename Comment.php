<?php
App::uses('AppModel','Model');
class Comment extends AppModel{
	public $validate =array(
	'name' =>array(
		'notEmpty'=>array(
		'rule'=>array('notEmpty'),
			'message'=>'名前を入力してください。',
		),
		'maxLength'=>array(
			'rule'=>array('maxLength',30),
				'message'=>'名前は30文字以内で入力してください。',
		),
	),
	'post_id'=>array(
		'rule'=>array('notEmpty'),
			'message'=>'id番号を入れてください。',
	),
		'comment'=>array(
			'notEmpty'=>array(
				'rule'=>array('notEmpty'),
					'message'=>'コメントを入力してください。',
			),
		),
	);		
}
?>
