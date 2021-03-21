const nextFirts = document.querySelector('#nextFirts'); //next firts
const prevSec = document.querySelector('#prevSec'); //prev Sec 
const nextSec = document.querySelector('#nextSec'); //next Sec
const prevThird = document.querySelector('#prevThird'); //prev Third
const send = document.querySelector('#send'); 
var atual, prev, next, index = 1;

//firts
nextFirts.onclick = function() {
    if(checkForm(1)){
        // PROGRESS
        atual =  (this.parentNode).parentNode; //pegando elemento pai
        next = atual.nextElementSibling; //pegando o proximo elemento
        atual.classList.remove("active"); // hide
        next.classList.add("active"); //show
        var progress = document.querySelector('#progress'); //progress
        progress = progress.children[index++]; //progress
        progress.classList.add("active-progress") //progress


        //request datapicker
        initDatePicker();
        
        // request horario
        requestHorario();
    }        
}

//sec
prevSec.onclick = function() {
    atual =  (this.parentNode).parentNode; //pegando elemento pai
    prev = atual.previousElementSibling; //pegando o proximo elemento
            
    atual.classList.remove("active"); // hide
    prev.classList.add("active"); //show

    var progress = document.querySelector('#progress'); //progress
    progress = progress.children[--index];
    progress.classList.remove("active-progress")
}

nextSec.onclick = function() {
    if(checkForm(2)){
        atual =  (this.parentNode).parentNode; //pegando elemento pai
        next = atual.nextElementSibling; //pegando o proximo elemento
                
        atual.classList.remove("active"); // hide
        next.classList.add("active"); //show
                
        var progress = document.querySelector('#progress'); //progress
        progress = progress.children[index]; //progress
        progress.classList.add("active-progress") //progress 
    }            
}

//third
prevThird.onclick = function() {
    atual =  (this.parentNode).parentNode; //pegando elemento pai
    prev = atual.previousElementSibling; //pegando o proximo elemento

    atual.classList.remove("active"); // hide
    prev.classList.add("active"); //show

    var progress = document.querySelector('#progress'); //progress
    progress = progress.children[index];
    progress.classList.remove("active-progress")
}

//send
send.onclick = function(){
    if(!checkForm(3)) return false;
}

//function check form
function checkForm(step){
    if(step == 1){ //CHECK STEP 1
        var city = formagendamento.city;
        city = city.options[city.selectedIndex].value;

        // CHECK CITY
        if(!checkCity(city)){
            formagendamento.city.style.border='1px solid #ff1f1f';
            return false;
        }else{formagendamento.city.style.border=''; }
        
        return true; // return true when going through all checks
    }

    if(step == 2){ //CHECK STEP 2
        var service = formagendamento.servico;
        service = service.options[service.selectedIndex].value;
        var date = formatarData(formagendamento.data.value);
        var hour = formagendamento.hora;
        hour = hour.options[hour.selectedIndex].value;

        if(!checkService(service)){
            formagendamento.service.style.border='1px solid #ff1f1f';
            return false;
        }else{ formagendamento.service.style.border=''; }

        if((date == 'Invalid Date') || date  == ""){
            formagendamento.data.style.border='1px solid #ff1f1f';
            return false;
        }else{ formagendamento.data.style.border=''; }

        if(!checkHour(hmsToSecondsOnly(hour))){
            formagendamento.hora.style.border='1px solid #ff1f1f';
                return false;
        }else{ formagendamento.hora.style.border=''; }

        //check time conflict
        if(checkHour(hmsToSecondsOnly(hour))){ //verrificar hour select valid 
            if(service==2){ // check if service == 2, to proceed with the checks
                try {
                    let nextHour =  hmsToSecondsOnly(getSelect('hour',1)); // get option hour  select (+ 1)
                    let plusHours = hmsToSecondsOnly(hour) + hmsToSecondsOnly('00:30:00'); // hour select plus 30 minutes
                    // check time conflict
                    if(plusHours < nextHour){ 
                        console.log('*Conflict of schedules! This service requires more hours');
                        formagendamento.hora.style.border='1px solid #ff1f1f';
                        return false;
                    }else{ formagendamento.hora.style.border=''; }
                }catch(e) {
                    console.log(e) 
                    // get error
                }
            }
        }

        return true; // return true when going through all checks
    }

    if(step == 3){ //CHECK STEP 3
        var name = formagendamento.name.value;
        var surname = formagendamento.surname.value;
        var phone = formagendamento.phone.value;
                
        if(name.length < 4){
            formagendamento.name.style.border='1px solid #ff1f1f';
            formagendamento.name.focus();
            return false;
        }else{ formagendamento.name.style.border=''; }

        if(surname.length < 4){
            formagendamento.surname.style.border='1px solid #ff1f1f';
            formagendamento.surname.focus();
            return false;
        }else{ formagendamento.surname.style.border=''; }

        //check phone
        if(phone.length < 15 || phone == ""){
            formagendamento.phone.style.border='1px solid #ff1f1f';
            formagendamento.phone.focus();
            return false;
        }else{ formagendamento.phone.style.border=''; }

        return true; // return true when going through all checks
    }
}   

//##CHECK
//function validate city
checkCity = (attr) => attr == 1 || attr == 2 ? true : false;

//validate service
checkService = (attr) => attr == 1 || attr == 2 ? true : false;

// check hour
checkHour = (attr) => Number.isInteger(attr) ? true : false;

//## TRANSFORMER
//convert hours in milis
function hmsToSecondsOnly(str) {
    var p = str.split(':'),  s = 0, m = 1;
    while (p.length > 0) {
        s += m * parseInt(p.pop(), 10);
        m *= 60;
    }

    return s;
}

//## GET
function getSelect(id, next=0){
    let select = document.getElementById(id);
    return  select.options[select.selectedIndex+next].value;
}

//##MASK
//mask phone
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