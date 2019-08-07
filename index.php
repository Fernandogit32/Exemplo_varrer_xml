
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="screen" />
    <script type="text/javascript" src="js/bootstrap.min.js.map"></script>
   
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
        }

        #buscar #bloco{
           
            border: 1px black solid;
            text-align: center;
            margin-right: 400px;
            margin-left:  400px;
            margin-bottom: 50px;
            margin-top: 50px;
            padding: 30px;
        }
        #buscar{
            width: 100%;;
        }
        h1{
            text-align: center;
        }
        #texto{
           text-align: center;
        }


    </style>
</head>
<body>





        <div id="buscar">
                <div id="bloco">
                       
          
                  <label></label><strong>Buscar por quantidade: </strong><input id="valor" value="0" type="number">
                  <button class="btn btn-success" id="consulta">Listar</button>
          
                </div>
          
              </div>
              <div id="texto">
                  <h1>Relação de Estoque</h1>
                  <button class="btn btn-success" id="cargaCatalogo">Listar</button>
              </div>
              <table id="demo"></table>
          
              <script>
                  document.getElementById("cargaCatalogo").addEventListener("click", cargarCatalogo);
                  function cargarCatalogo() {
                      var xhr = new XMLHttpRequest();
                      xhr.onreadystatechange = function () {
                          if (this.readyState == 4 && this.status == 200) {
                              cargarXML(this);
                          }
                      };
                      xhr.open("GET", "relatorio.xml", true);
                      xhr.send();
                  }
                  function cargarXML(xml) {
                      var docXML = xml.responseXML;
                      var tabla = "<tr><th>Código</th><th>Descrição</th><th>Qtd Estoque</th></tr>";
                      var discos = docXML.getElementsByTagName("PRODUTO");
                      for (var i = 0; i < discos.length; i++) {
                          
                          tabla += "<tr><td>";
                          tabla += discos[i].getElementsByTagName("Field")[0].textContent.substring(0,6);
                          tabla += "</td><td>";
                          tabla += discos[i].getElementsByTagName("Field")[5].textContent;                
                          tabla += "</td><td>";
                          tabla += discos[i].getElementsByTagName("Field")[4].textContent.substring(0,5);
                          
                      }
                      document.getElementById("demo").innerHTML = tabla;
                  }
          
          
          
          
          
                  
                  document.getElementById("consulta").addEventListener("click", consulta);
                  function consulta() {
                      var xhr = new XMLHttpRequest();
                      xhr.onreadystatechange = function () {
                          if (this.readyState == 4 && this.status == 200) {
                              cargar(this);
                          }
                      };
                      xhr.open("GET", "relatorio.xml", true);
                      xhr.send();
                  }
                  function cargar(xml) {
                      var valor = document.getElementById("valor");
                      
                      var docXML = xml.responseXML;
                      var tabla = "<tr><th>Código</th><th>Descrição</th><th>Qtd Estoque</th></tr>";
                      var discos = docXML.getElementsByTagName("PRODUTO");
                      for (var i = 0; i < discos.length; i++) {
                          
                          var qtd =  discos[i].getElementsByTagName("Field")[4].textContent.substring(0,5)
                         
           
                       qtd = qtd.toString().replace(",", ".");
                       
                          
                          if(Number(valor.value)  == Math.round(Number(qtd))){
                              tabla += "<tr><td>";
                                      tabla += discos[i].getElementsByTagName("Field")[0].textContent.substring(0,6);;
                                      tabla += "</td><td>";
                                      tabla += discos[i].getElementsByTagName("Field")[5].textContent;
                                      tabla += "</td><td>";                            
                                      tabla += discos[i].getElementsByTagName("Field")[4].textContent.substring(0,5);
                          }                
                          
                          
                      }
                      document.getElementById("demo").innerHTML = tabla;
                  }                 
          
              </script>
                      


    
</body>
</html>
<html>

