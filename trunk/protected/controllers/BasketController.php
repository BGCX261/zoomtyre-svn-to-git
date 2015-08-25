<?php
class BasketController extends Controller {
	public function actionIndex(){
		$cart = Yii::app()->shoppingCart;
		$model = new OrderForm;
		
		if(Yii::app()->user->isGuest)
			$model->scenario = 'guest_order';
		else {
			$user = User::model()->findByPk(Yii::app()->user->name);
			$model->client = Yii::app()->user->name;

			if(!empty($user->client)) {
				$model->name = $user->client->name;
				$model->phone = $user->client->phone;
				$model->email = $user->client->email;
				$model->city = $user->client->city;
				$model->address = $user->client->address;
			}
		}

		if(isset($_POST['OrderForm'])){
			$model->attributes = $_POST['OrderForm'];
			
			if($model->validate()) {
				$order = new Order;

				$order->attributes = $model->attributes;
				$order->created = date('Y-m-d H:i:s');
				
				$tmp = array();
				$positions = $cart->getPositions();
				foreach($positions as $k => $position)
					$tmp[] = array('item'=>preg_split('/_/', $k), 'price'=>$position->getPrice(), 'quantity'=>$position->getQuantity());
				
				$order->order = CJSON::encode($tmp);
				$order->status = L::r_item('orderStatus', 'new');
				$order->data = CJSON::encode($order->attributes);
				if($order->save()){

					Yii::app()->getSession()->add('order', $order);

					$cart->clear();
					$this->redirect(array('basket/done'));
				} else
					$model->addError('error', 'Мы не можем обработать Ваш заказ.');
			}
		}
		
		$this->render('index', array(
			'model'=>$model,
			'cart'=>$cart,
		));
	}
	
	public function actionDone(){
		$order = Yii::app()->getSession()->get('order');
		$registration_form = new RegistrationForm;
		$this->render('done', array('order'=>$order, 'registration_form'=>$registration_form));
	}
	
} 