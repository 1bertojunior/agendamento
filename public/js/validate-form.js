function valiForm(){
  var name = formagendamento.nome.value;
  var phone = formagendamento.phone.value;
  var service = formagendamento.servico;
  service = service.options[service.selectedIndex].value;
  var date = getFormattedDate(formagendamento.data.value);
  var hour = formagendamento.hora;
  hour = hour.options[hour.selectedIndex].value;
  
  
  //verrifying Name
  if(name.length < 4){
    console.log('ERRO name')
    addWarningInput('name'); // add Warning Text
    formagendamento.nome.style.border='2px solid #ff1f1f';
    formagendamento.nome.focus();
    return false;
  }else{
    formagendamento.nome.style.border=''; 
    addWarningInput('name', true); // remove Warning Text
  } //remove border red 
  //verrifying Phone
  if(phone.length < 15 || phone == ""){
    console.log('ERRO phone')
    addWarningInput('phone')
    formagendamento.phone.style.border='2px solid #ff1f1f';
    formagendamento.phone.focus();
    return false;
  }else{
    addWarningInput('phone', true); // remove Warning Text
    formagendamento.phone.style.border='';  //remove border red 
  }
  //verrifying Date
  if(!(date == 'Invalid Date') || date  == ""){
    console.log('ERRO date')
    addWarningInput('date'); // add Warning Text
    formagendamento.data.style.border='2px solid #ff1f1f';
    return false;
  }else{
    addWarningInput('date', true); // remove Warning Text
    formagendamento.data.style.border=''; //remove border red 
  }
  //verrifying Hour
  if(!valiHour(hmsToSecondsOnly(hour)) ){
    console.log('ERRO hour')
    addWarningInput('hour'); // add Warning Text
    formagendamento.hour.style.border='2px solid #ff1f1f';
    return false;
  }else{
    addWarningInput('hour', true); // remove Warning Text
    formagendamento.hour.style.border='';
  }

  //verrifying Service
  if(!valiService(service)){//verrificar service != 1 OR 2
    console.log('ERRO service invalid')
    addWarningInput('service'); // add Warning Text
    formagendamento.servico.style.border='2px solid #ff1f1f';
    return false;
  }else{
    addWarningInput('service', true); // remove Warning Text
    formagendamento.servico.style.border=''; //remove border red
  } 

  //verrificar conflito de horarios
  if(valiHour(hmsToSecondsOnly(hour))){ //verrificar hour select valid
    if(service==2){ // verrificar  se service == 2, para assim, prosseguir nas validações
      let nextHour =  getSelect('hour',1); //get option select hour+1
      let plusHours = hmsToSecondsOnly(hour) + hmsToSecondsOnly('00:30:00'); //hour select plus 30 minutes
      
      if( plusHours < hmsToSecondsOnly(nextHour)){ //verrificar conflito de hours
        addWarningInput('hour', false,"*Conflito de horários! Este serviço requer mais horario"); // add Warning Text
        return false;
      }else{
        addWarningInput('service', true); // remove Warning Text
      }
    }
  }
  
}

//formatted date
function getFormattedDate(d){
  d = d.split(" "); //transforme string in array 
  d = (d[2]) +"-"+ addZero(meses.indexOf(d[1])+1) +"--"+  addZero((d[0]));
  return new Date(d);
}
//function add zero in number < 10
addZero = (attr) => attr < 10 ? '0' + attr : attr;

//function add AND remove text Warning
function addWarningInput(campo, remove=false, msg ="*Campo obrigatório!" ) {
  var parentEl = document.getElementById("form-grupo "+campo); // Buscar elemento pai
  var warning =parentEl.children;
  var exist = [false, false];
  for(let i=0; i<parentEl.children.length; i++) if( parentEl.children[i].id == "txtWarningInput") exist = [i,true];   
  
  if(remove){
    if(exist[1]) parentEl.children[exist[0]].remove();  
  }else{
    if(!exist[1]){
      var el = document.createElement('p'); // Criar elemento
      var text = document.createTextNode(msg); // Criar o nó de texto
      el.appendChild(text); // Anexar o nó de texto ao elemento h1
      el.style = "color: red"; // add color red at the text
      el.setAttribute("id", "txtWarningInput");
      parentEl.appendChild(el); // Agora sim, inserir (anexar) o elemento filho (titulo) ao elemento pai (body)
    }
  }

}

//function validadet hour
function valiHorario(atrr){
  for(let i = 0; i<7; i++) if(atrr == horarios[i]) return true;
  return false;
}

//pegar select 
function getSelect(id, next=0){
  let select = document.getElementById(id);
  return  select.options[select.selectedIndex+next].value;
}

//validate service
function valiService(attr){
  if(attr == 1 || attr == 2) return attr;
  return 0;
}

function valiHour(attr){
  return Number.isInteger(attr) ? true : false;
}

//convert hours in milis
function hmsToSecondsOnly(str) {
  var p = str.split(':'),  s = 0, m = 1;

  while (p.length > 0) {
    s += m * parseInt(p.pop(), 10);
    m *= 60;
  }

  return s;
}

//mascara phone
function mask(o, f) {
  setTimeout(function() {
    var v = mphone(o.value);
    if (v != o.value) {
      o.value = v;
    }
  }, 1);
}
//mascara phone
function mphone(v) {
  var r = v.replace(/\D/g, "");
  r = r.replace(/^0/, "");

  if (r.length > 10) {
    r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
  }else if (r.length > 5) {
    r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
  }else if (r.length > 2) {
    r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
  }else {
    r = r.replace(/^(\d*)/, "($1");
  }
  
  return r;
}


