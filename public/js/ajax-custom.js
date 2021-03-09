function requestHorario(city,data){
  document.getElementById('hour').innerHTML = ''

  // verificar se já existe a imagemd e loading
  if(!document.getElementById('loading')){
    //incluir gif de loading na pagina
    let imgLoading = document.createElement('img');
    imgLoading.src = 'img/loading.gif';
    imgLoading.id = 'loading'
    imgLoading.className = 'rounded mx-auto d-block';
    document.getElementById('hour').appendChild(imgLoading);
  }
      
  let ajax = new XMLHttpRequest();
  //conexão estabelecida com o servidor - state = 1
  ajax.open('GET', 'ajaxAdmin?date='+data+'&city='+city);
  // /ajaxAdmin?date=2021-02-01&city=1
  
  //progresso da requisição
  ajax.onreadystatechange = () => {
    // requisição finalizada
    if(ajax.readyState == 4 && ajax.status == 200){
      document.getElementById('loading').remove(); //remover imagem de loading
    
      horarios = JSON.parse(ajax.responseText) //arr horarios convertido em JSON
      addOption('Selecione um horário', true) 
      for (let i = 0; i < 30; i++) {
        if(horarios[i] != undefined)addOption(horarios[i])      
        // console.log(horarios[i]) 
      }

    }
  
    if(ajax.readyState == 4 && ajax.status == 404) console.log('STRF_status: 404') //error

  }

  ajax.send()
}


//função add option ao select
function addOption(valor, t=false){
  if(t) var option = new Option(valor);
  var option = new Option(valor, valor);
  var select = document.getElementById("hour");
  select.add(option);
}
