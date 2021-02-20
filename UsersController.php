<?php
App::uses('AppController','Controller');
class UsersController extends AppController{
	public $components=array('Auth'=>array('loginRedirect'=>array('controller'=>'posts','action'=>'index')));

	//認証を使わないページの設定
	public function beforeFilter(){
			//addアクションを、ログインしなくてもアクセスすることができるようにする。
			$this->Auth->allow('add');
			//ログイン情報を「auth」という変数名で画面に渡す
			$this->set('auth',$this->Auth->user());
			

	}

	//ログイン処理
	public function login(){
			if($this->request->is('post')){//フォームから送信されてきた場合
				if($this->Auth->login()){//アカウントの認証がOKだったら
					$this->redirect($this->Auth->redirect());//ユーザー一覧画面へ遷移します。
				}else{
					$this->Session->setFlash(__('認証に失敗しました。'));//エラーメッセージを表示します。
				}
				return $this->redirect(array('action'=>'index'));
			}
	}
	
	//ログアウト処理
	public function logout(){
		$this->redirect($this->Auth->logout());//ログアウトします。
	}	
	public function index(){
		$this->layout='admin';
		$users=$this->User->find('all');
		$this->set('users',$users);
		}
	public function add(){
		if($this->request->is('post')){//<form>からPOST送信されてきた場合
			if($this->User->save($this->request->data)){//送信されてきたデータをusersテーブルに保存
				$this->Session->setFlash('登録されました');//メッセージを表示
				return $this->redirect(array('action'=>'index'));//一覧画面を表示
			} 
		}
	}
	public function edit($id=null){
		if($this->request->is(array('post','put'))){
			if($this->User->save($this->request->data)){
				$this->Session->setFlash(__('保存しました'));
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Session->setFlash(__('保存できませんでした'));
			}
		}else{
			$options=array('conditions'=>array('User.'.$this->User->primaryKey=>$id));
			$this->request->data=$this->User->find('first',$options);
		}
	}

}
?>
