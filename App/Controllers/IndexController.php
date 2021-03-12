<?php

namespace App\Controllers;

//os recursos do agendou
use App\Models\agendamento;
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
		// header('Location: agendamento');
		$this->render('index', 'layout', 'Home');
	}

	public function city() {
		$this->render('city', 'layout1', 'Escolha a cidade');
	}

	public function agendamento(){
		$agenda = Container::getModel('Agendamento');
		$this->view->erroCadastro = false;
		$this->view->dados = [
			'city' => $agenda->getCity()
		];
		
		$this->render('agendamento', 'layout1', 'Agendamento online');
	}

	public function ajaxAdmin(){
		$agenda = Container::getModel('Agendamento');
		$agenda->getTimesFreeByCityAndDate(); // return json 
	}

	public function holidays(){
		$holidays = Container::getModel('Agendamento');
		$holidays->getHolidays();
	}

	public function daysoff(){
		$daysoff = Container::getModel('Agendamento');
		$daysoff->getDaysOff();

	}

	public function searchagendamento(){
		$this->render('searchagendamento', 'layout_default', 'Search');
	}

	public function searchByIdAndPhone(){
		$agendamento  = Container::getModel('Agendamento');
		$agendamento->__set('id', $_POST['id']);
		$agendamento->__set('phone', $_POST['phone']);

		if($agendamento->getAgendamento()){
			$delete = $agendamento->dateSmallerStart();
			$this->view->info = [
				'alert' => false,
				'text' => false,
				'name' => true,
				'delete' => $delete
			];
			$this->view->dados = [
				'id' => $agendamento->__get('id'),
				'city' => $agendamento->__get('city'),
				'service' => $agendamento->__get('service'),
				'name' => $agendamento->__get('name'),
				'phone' => $agendamento->__get('phone'),
				'date' => $agendamento->__get('start')
			];
			// echo json_encode($agendamento->getAgendamento());
			$this->render('agendamento_dados', 'layout1', 'Resultado');  //redirecionar p/ o bilhete success
		}else{
			$this->view->info = [
				'title' => '404 - Result Not Found',
				'body' => 'Desculpe, a reserva solicitada não foi encontrada!',
				'btn' => 'Tentar novamente'
			];
			$this->render('404', 'layout1', '404');
		}
	}

	//gravar agendamento
	public function agendar(){
		$agendar = Container::getModel('Agendamento');

		$date = $agendar->formateDate($_POST['data']);
		$horas = $_POST['hora'];
		$service = $_POST['servico'];
		$start =  $agendar->datePatternDb($date, $horas);
		$horas =  date("H:i:s", strtotime("$horas ". $agendar->dateEnd($service)));
		$end =  $agendar->datePatternDb($date, $horas);

		$agendar->__set('city', $_POST['city']);
		$agendar->__set('name', $_POST['nome']);
		$agendar->__set('phone', $_POST['phone']);
		$agendar->__set('service', $service);
		$agendar->__set('start', $start);
		$agendar->__set('end', $end);

		//validar
		if($agendar->validar() && count($agendar->getAgendamentoDouble()) == 0){
			//salvar
			$agendar->save(); //salvar agendamento
			$delete = $agendar->dateSmallerStart();
			$this->view->info = [
				'alert' => true,
				'text' => true,
				'name' => false,
				'delete' => $delete
			];
			$this->view->dados = [
				'id' => $agendar->__get('id'),
				'city' => $agendar->__get('city'),
				'phone' => $agendar->__get('phone'),
				'service' => $agendar->__get('service'),
				'name' => $agendar->__get('name'),
				'date' => $agendar->__get('start')
			];

			$this->render('agendamento_dados', 'layout1', 'Sucesso');  //redirecionar p/ o bilhete success
		}else{
			// erro
			$this->view->erroCadastro = true;
			$this->view->dados = [
				'id' => $agendar->__get('id'),
				'city' => $agendar->__get('city'),
				'phone' => $agendar->__get('phone'),
				'service' => $agendar->__get('service'),
				'name' => $agendar->__get('name'),
				'date' => $agendar->__get('start')
			];
			$this->render('agendamento', 'layout1', 'Agendamento online');
		}	
		
	}

	//deletar agendamento
	public function delete(){
		$agendar = Container::getModel('Agendamento');

		if(isset($_GET['id'])) $agendar->__set('id', $_GET['id']);
		if(isset( $_GET['phone'])) $agendar->__set('phone', $_GET['phone']);

		echo $agendar->dateSmallerStart();

		if($agendar->valiDelete()){
			$agendar->delete();
			header('Location: /agendamento');
		}else{
			echo 'erro ao deletar';
		}
		
	}

}


?>