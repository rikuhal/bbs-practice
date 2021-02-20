<?php
App::uses('AppController','Controller');
class PostsController extends AppController{
	public $components=array('Paginator','Auth');
	
	public function beforeFilter(){
		//addアクションを、ログインしなくてもアクセスすることができるようにする。
		$this->Auth->allow(['index','search','view']);
		//ログイン情報を「auth」という変数名で画面に渡す
		$this->set('auth',$this->Auth->user());
}
public function login(){
	if($this->request->is('post')){//フォームから送信されてきた場合
		if($this->Auth->login()){//アカウントの認証がOKだったら
			$this->redirect($this->Auth->redirect());
			
		}else{
			$this->Session->setFlash(__('認証に失敗しました。'));//エラーメッセージを表示します。
		}
	}
}
public function logout(){
	$this->redirect($this->auth->logout());
}
	public function index(){
		$paginate=array(
			'limit'=>5,
			'order'=>array(
			'Post.created'=>'desc',
			),
			'conditions'=>array('Post.status'=>'0'),
			);
		
		$this->Paginator->settings=$paginate;
		$posts=$this->Paginator->paginate();
		$this->set('posts',$posts);//$postの内容を'posts'という名前でViewに渡す。
		
	}

	public function add(){
		$this->layout='admin';
		if($this->request->is('post')){//<form>からPOST送信されてきた場合
			if($this->Post->save($this->request->data)){//送信されてきたデータをpostsテーブルに保存
				$this->Session->setFlash('登録されました');//メッセージを表示
				return $this->redirect(array('action'=>'index'));//一覧画面を表示	
			}
		}	
	}
	public function edit($id=null){//記事末尾のIDを取得。なければnullを入れる
		if($this->request->is(array('post','put'))){//<form>から送信されてきた場合
			//ここに送信時の処理を書く
			if($this->Post->save($this->request->data)){//Formから送信されてきたデータを保存し、保存できた場合
				//$dataにidが含まれていると編集され、idが含まれていない場合は新規追加される
				$this->Session->setFlash(__('保存しました'));//「保存しました」とメッセージを表示
				return $this->redirect(array('action'=>'index'));//indexへ遷移
			}else{
				$this->Session->setFlash(__('保存できませんでした'));//保存できなかった場合
			}
		}else{//初期表示時
			$options=array('conditions'=>array('Post.'.$this->Post->primaryKey=>$id));//検索条件をpostテーブルのid=URL末尾の記事のIDにする
			$this->request->data=$this->Post->find('first',$options);//設定した検索条件で検索し、1件目を取得し、画面へ渡す
		}
	}
	public function delete($id=null){//URLの末尾のIDを取得
		if($this->request->is('post')){//送信されてきた場合
			if($this->Post->delete($id)){//該当のidを削除し、OKだったら「削除しました」と表示し、NGだったら「削除できませんでした」と表示する
				$this->Session->setFlash(__('削除しました'));
			}else{
				$this->Session->setFlash(__('削除できませんでした'));
			}
			return $this->redirect(array('action'=>'index'));//一覧画面に自動的に遷移する
		}
		return $this->redirect(array('action'=>'index'));
	}
	public function view($id=null){//URLの末尾のIDを取得する
		$options=array('conditions'=>array('Post.id'=>$id));//検索条件を指定
		$data=$this->Post->find('first',$options);//データベースからデータを1件取得
		$this->set('post',$data);//取得したデータを、postという変数名でViewに渡す
		
	}
	public function search(){
		$conditions=array();
		//URLパラメータに「keyword」があった場合
		if(isset($this->params['url']['keyword'])){
			//キーワードを取得します。
			$keyword=$this->params['url']['keyword'];
			//検索条件に「タイトルにキーワードを含む」を追加します。
			array_push($conditions,array(
				'OR'=>array(
					'Post.title LIKE'=>'%'.$keyword.'%',
					'Post.body LIKE'=>'%'.$keyword.'%'
					)
				)
			);
		}
		if(isset($this->params['url']['name'])){
			$name=$this->params['url']['name'];
			array_push($conditions,array(
				'OR'=>array(
					'Post.writer LIKE'=>'%'.$name.'%'
					)
			)
		);
		}
		$paginate=array(
			'limit'=>5,
			'order'=>array(
			'Post.created'=>'desc',
			),
			//条件の設定
			'conditions'=>$conditions,
			);
		$this->Paginator->settings=$paginate;
		//データの取得
		$posts=$this->Paginator->paginate();
		//viewにデータを渡す	
		$this->set('posts',$posts);
	}
	public function mypost(){
		$this->layout='admin';
		//ControllerからユーザーIDを取得
		$user_id=$this->Auth->user('id');
		$paginate=array(
			'limit'=>5,
			'order'=>array(
			'Post.created'=>'desc',
			),
			'conditions'=>array('user_id'=>$user_id)
			);
		
		$this->Paginator->settings=$paginate;
		$data=$this->Paginator->paginate();
		$this->set('data',$data);//$user_idの内容を'user_id'という名前でViewに渡す。
	}
	
	
	

	
}


?>
