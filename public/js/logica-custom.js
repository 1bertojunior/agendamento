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

// pegar data
function getData(data){
    let city = document.getElementById('city')
    city = city.value
    data = formatarData(data)
    //console.log(data)//

    requestHorario(city, data)
}
  
function formatarData(data) {
    data = data.value.split(" ")
    data.reverse()
    data[1] = meses.indexOf(data[1], [i = 0])+1
    data = data.join('-')
    data = new Date(data)
    //addzero
    data = data.getFullYear() +"-"+ addZero((data.getMonth()+1)) +"-"+ addZero(data.getDate().toString())
    
    return data
}

function addZero(n){
    if (n <= 9) return "0" + n;
    return n; 
}
  