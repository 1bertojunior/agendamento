var meses = [
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

// get city
function getCitySelected(){
    var city = document.getElementById('city');
    city = city.options[city.selectedIndex].value;
    return city;
}

// pegar data
function getDateSelected(){
    let date = document.querySelector("#datepicker-default");
    date = formatarData(date.value)
    return date;
}
  
function formatarData(data) {
    data = data.split(" ")
    data.reverse()
    data[1] = meses.indexOf(data[1], [i = 0])+1
    data = data.join('-')
    data = new Date(data)
    // //addzero
    data = data.getFullYear() +"-"+ addZero((data.getMonth()+1)) +"-"+ addZero(data.getDate().toString())
    
    return data
}

function addZero(n){
    if (n <= 9) return "0" + n;
    return n; 
}
  