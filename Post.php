<?php
App::uses('AppModel','Model');
class Post extends AppModel{//Model名は「Post」になる。
    public $validate=array(//入力チェックを設定する
        'title'=>array(//タイトルに対して入力チェックを設定
            'notEmpty'=>array(
                'rule'=>array('notEmpty'),//入力チェックのルールは『入力必須」
                'message'=>'タイトルを入力してください。'//表示するエラーメッセージを設定
            ),
            'maxLength'=>array(
                'rule'=>array('maxLength',30),
                    'message'=>'タイトルは30文字以内で入力してください。',
            ),
        ),
        'body'=>array(
            'notEmpty'=>array(
                'rule'=>array('notEmpty'),
                'message'=>'本文を入力してください。',
            ),
        ),
        'writer'=>array(
            'notEmpty'=>array(
                'rule'=>array('notEmpty'),
                'message'=>'投稿者名を入力してください。'
            ),
            'maxLength'=>array(
                'rule'=>array('maxLength',10),
                'message'=>'投稿者は10文字以内で入力してください。'
            ),
        ),
    );
    public $hasMany=array(
		'Comment'=>array(
			'className'=>'Comment',
			'foreignKey'=>'post_id',//Postモデルに対しCommentモデルが1:nの関係で、Commentモデルのpost_idがPostモデルのidであることを定義します。
			'dependent'=>false,
		)
	);
}

?>
