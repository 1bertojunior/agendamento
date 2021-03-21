<?php

    namespace App\Models;
    use MF\Model\Model;

    class agendamento extends Model{

        private $id;
        private $city;
        private $name;
        private $surname;
        private $phone;
        private $service;
        private $start;
        private $end;

        //metodo mafico get
        public function __get($attr){
            return $this->$attr;
        }
        //metodos mafico set
        public function __set($attr, $value){
            $this->$attr = $value;
        }
        
        //metodos all hours actives
        public function getAllHoursActive(){
            $hour =  date('H:i:s'); //get hour current
            $hour = date("H:i:s", strtotime("$hour + 25 minutes")); // hour current sum adding 25 minutes
            $dateTime = date('Y-m-d') .' '.  $hour;
            $ano = $this->getDate();
    
            $query = "SELECT value_time FROM horarios
                        WHERE active = 1 AND CONCAT('$ano ',value_time) > :hour";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':hour', $dateTime);
            $stmt->execute();            
            // $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return call_user_func_array('array_merge',$stmt->fetchAll(\PDO::FETCH_NUM));
        }

        //method all scheduled times by city and date # retorna todos os horarios (start/end) agendados por cidade e data
        public function getAllScheduledTimesByCityAndDate(){
            $query = "SELECT DATE_FORMAT(data, '%H:%i:%S'), DATE_FORMAT(data_end, '%H:%i:%S') FROM agendamentos
                        WHERE fk_city = :city AND DATE_FORMAT(data, '%Y-%m-%d') = :date";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':city', $this->getCity());
            $stmt->bindValue(':date', $this->getDate());
            $stmt->execute();

            return call_user_func_array('array_merge', $stmt->fetchAll(\PDO::FETCH_NUM));

        }
        
        //method return (all) times free by city and date  # Metodo retorna todos os horarios livres por cidade e data
        public function getTimesFreeByCityAndDate(){
            $hours = [];

            for($i=0; $i < sizeof($this->getAllScheduledTimesByCityAndDate()); $i++){
                if($i % 2 == 0){
                    $start = $this->getAllScheduledTimesByCityAndDate()[$i];
                    $end = $this->getAllScheduledTimesByCityAndDate()[$i+1];
                    foreach ($this->getAllHoursActive() as $key => $value) {
                        if($this->checkInterval($value, $start, $end)) {
                             array_push($hours,$value);
                        }//usando a verificação...
                    }
                }
            }

            $result = array_diff($this->getAllHoursActive(), $hours);
            // return $result;
            echo json_encode($result); 

        }

        public function checkInterval($dateInterval,$startDate,$endDate) {
            $dateInterval = new \DateTime($dateInterval);
            $startDate = new \DateTime($startDate);
            $endDate = new \DateTime($endDate);
     
            $startDate->format('H:i:s'); 
            $endDate->format('H:i:s'); 
     
            return ($dateInterval->getTimestamp() >= $startDate->getTimestamp() &&
               $dateInterval->getTimestamp() < $endDate->getTimestamp());
        } 

        // get ALL os hours active
        public function getFullHours(){
            $query = "SELECT * FROM horarios WHERE active = 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $times = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $times;
        }

        public function recuperar($city, $day){
                        
            $query = "SELECT id, fk_city, nome, data, data_end FROM agendamentos WHERE fk_city = :city AND DATE_FORMAT(data, '%Y-%m-%d') = :day";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':city', $city);
            $stmt->bindValue(':day', $day);
            $stmt->execute();

            $events = [];
            $i = 0;
            $times = $this->getFullHours();

            while($row_events = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $events[$i] = [
                    'id' => $row_events['id'],
                    'title' => $row_events['nome'],
                    'city' => $row_events['fk_city'],
                    'start' => $row_events['data'],
                    'end' => $row_events['data_end']
                 ];
                $i++;
            }

            return $events;      

        }

        // search agendamento by id AND phone
        public function getAgendamento(){
            $query = "SELECT id, fk_city, nome, phone, fk_servico, data, data_end FROM agendamentos
                            WHERE id = :id AND phone = :phone ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id", $this->__get('id'));
            $stmt->bindValue(":phone", $this->__get('phone'));
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if($result){
                $this->__set('city', $result['fk_city']);
                $this->__set('name', $result['nome']);
                $this->__set('service', $result['fk_servico']);
                $this->__set('start', $result['data']);
            }

            return $result;
        }

        //deletar agendamento por ID and PHONE
        public function delete(){
            $query = "DELETE FROM agendamentos WHERE id = :id ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id", $this->__get('id'));

            $stmt->execute();
            if($stmt->rowCount()) true;
        }

        //validar delete
        public function valiDelete(){
            $val = true;
            $id = $this->__get("id");
            $phone = strlen($this->__get('phone')) < 15 ? 1 : 0;

            if(!isset($id)) $val = false; // validar id
            if( $phone) $val = false;

            return $val;
        }

        public function dateSmallerStart(){
            $today = Date('Y-m-d H:i:s'); // horario atual
            $start = $this->__get('start'); 
            return strtotime($today) < strtotime("$start - 2 hours") ? true : false;
        }

        //metodo p/ pegar dias off 
        public function getDaysOff(){
            $query = "SELECT day  FROM daysoff WHERE fk_city = :city AND status = :active";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':city', $this->__get('city'));
            $stmt->bindValue(':active', 1);
            $stmt->execute();

            $days = [];

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) array_push($days, $row['day']);

            echo json_encode($days);
        }

        //metodo p/ pegar datas dos feriados
        public function getHolidays(){
            $query = "SELECT dateHoliday FROM holidays WHERE DATE_FORMAT(dateHoliday, '%Y') = '2021'";
            //colocar ano dinâmico
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $holidays = [];

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                array_push($holidays, $row['dateHoliday']);
            }
            echo json_encode($holidays);
        }
        
        public function getHoursOfDay(){

            $date = $this->getDate();
            $city = $this->getCity();
            //echo $city;
            $events = $this->recuperar($city, $date);
            $fullHours = $this->getFullHours();

            $fullTimes = [];
            $fullOff = [];
            $i = 0;

            foreach($fullHours as $t) array_push($fullTimes, date($t['value_time']));

            foreach($events as $e) {
                $t = strtotime($e['start']);
                array_push($fullOff, date('H:i:s', $t));
            }

            $diff = [];

            $diff = array_diff($fullTimes,$fullOff);

            echo json_encode($diff);
        }

        public function getAgendamentoDouble(){
            $query = "SELECT data FROM agendamentos
                WHERE fk_city = :city AND fk_servico = :service AND data = :start AND data_end = :end";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':city', $this->__get('city'));
            $stmt->bindValue(':service', $this->__get('service'));
            $stmt->bindValue(':start', $this->__get('start'));
            $stmt->bindValue(':end', $this->__get('end'));
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }


        //validar se cadastro pode ser feito
        public function validar(){
            $val = true;

            if(!$this->valiCity($this->__get('city'))) $val = false; //validar cidade
            if(strlen($this->__get('name')) < 4) $val = false; //validar nome >=5
            if(strlen($this->__get('phone')) < 15) $val = false; //validar telefone >=15
            if(!$this->validateDate($this->__get("start"))) $val = false;
            if(!$this->validateDate($this->__get("end"))) $val = false;
            if($this->__get('service') != 1 && $this->__get('service') != 2) $val = false;     
            if(!$this->valiCity($this->__get('city'))) $val = false;    

            return $val;


        }

        //salvar agendamento no db
        public function save(){
            $query = "INSERT INTO agendamentos (fk_city, nome, surname, phone, fk_servico, data, data_end) VALUES (:city, :name, :surname, :phone, :service, :start, :end)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':city', $this->__get('city'));
            $stmt->bindValue(':name', $this->__get('name'));
            $stmt->bindValue(':surname', $this->__get('surname'));
            $stmt->bindValue(':phone', $this->__get('phone'));
            $stmt->bindValue(':service', $this->__get('service'));
            $stmt->bindValue(':start', $this->__get('start'));
            $stmt->bindValue(':end', $this->__get('end'));
            $stmt->execute();
            $this->__set("id", $this->db->lastInsertId());
            return $this;
        }
        
        //metodos get date AND city
        public function getCity(){
            if( !isset($_REQUEST['city']) || !$this->valiCity($_REQUEST['city'])) return false;
            return $_REQUEST['city'];
        }

        public function valiCity($attr){
            return $attr != 1 && $attr != 2 ? false: true;
        }

        public function getDate(){
            return  empty($_REQUEST['date']) ? date("Y-m-d") :  $_REQUEST['date'];
        }

        //validar data
        public function validateDate($date, $format = 'Y-m-d H:i:s'){
            $d = \DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }

        //calcular data final
        public function datePatternDb($s,$e){
            return $s." ". $e;
        }

        //calculate datetime end
        public function dateEnd($s){
            if($s == 1) return " + 30 minutes";
            if($s == 2) return " + 1 hours";
        }

        //formatar data
        public function formateDate($d){
            $meses = [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ];

            //Converter a data e hora para o formato do BD.
	        $data = array_reverse(explode(" ", $d)); // removendo espaços e retornando um array
            foreach ($meses as $i => $mes) if($data[1] == $mes) $data[1] = $i+1;  // converterndo o nome mês para o inteiro
            $data = implode("-", $data); // colocado '-' entre dia, mes e ano
            $data = strtotime($data); // convetertendo para miles
            $data =  date('Y-m-d',$data); // convertendo para padrão db

            
            return $data;

        }

        public function listEvents(){
            $query = "SELECT id, fk_city, nome, phone, fk_servico, data, data_end FROM agendamentos WHERE fk_city = :city";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':city', $this->__get('city'));
            $stmt->execute();
            
            $events = [];

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $events[] = [
                    'id' => $row['id'],
                    'color' => '#666',
                    'title' => $row['nome'],
                    'start' => $row['data'],
                    'end' => $row['data_end']
                ];

            }

            echo json_encode($events);

        }

        public function getDataById(){
            $query = "SELECT id, fk_city, nome, surname, phone, fk_servico, data, data_end, created
                FROM agendamentos WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->execute();
            
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $schedules = [
                    'id' => $row['id'],
                    'city' => $row['fk_city'],
                    'name' => $row['nome'],
                    'surname' => $row['surname'],
                    'phone' => $row['phone'],
                    'service' => $row['fk_servico'],
                    'start' => $row['data'],
                    'end' => $row['data_end'],
                    'created' => $row['created'],
            ];

            echo json_encode($schedules);
        }

        

    }


?>