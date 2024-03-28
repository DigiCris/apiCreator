// Datos de ejemplo
var auxSQL = [
    ["authSet","rol|sesion","rol>2|id"],
    ["authProc","proc","http://comunyt.com"],
    ["authDel","rol","role>4"],
    ["authUpdate","sesion","id"]
  ];

  // Variable global para almacenar los datos de la tabla
  var columnasSQL = [];
  
  // Obtener referencia a la tabla y al botón de agregar
  var tabla = document.getElementById("tabla");
  var btnAgregar = document.getElementById("btn-agregar");
  
  // Agregar eventos a los elementos
  btnAgregar.addEventListener("click", function() {
    //agregarFila();
    cargarDatosIniciales(auxSQL2)
  });
  
  // Función para agregar una fila a la tabla
  function agregarFila() {
    var fila = document.createElement("tr");
  
    var tiposEntrada = [
      "text", // $nombre
      "select", // $tipo
      "number", // $longitud
      "text", // $predeterminado
      "checkbox", // $nulo
      "checkbox", // $autoincremental
      "text", // $descripcion
      "checkbox" // $primary
    ];
  
    for (var i = 0; i < 8; i++) {
        var celda = document.createElement("td");
        var input;
        
          input = document.createElement("input");
          input.type = tiposEntrada[i];
        
        input.value = "";
        
        input.classList.add("input"); // Agregar la clase "input" al elemento input o select
        
        celda.appendChild(input);
        fila.appendChild(celda);
      }
  
    // Agregar botón de eliminación
    var celdaEliminar = document.createElement("td");
    var btnEliminar = document.createElement("button");
    btnEliminar.textContent = "Eliminar";
    btnEliminar.addEventListener("click", function() {
      eliminarFila(fila);
    });
    celdaEliminar.appendChild(btnEliminar);
    fila.appendChild(celdaEliminar);
  
    tabla.appendChild(fila);
  }
  
  // Función para eliminar una fila de la tabla
  function eliminarFila(fila) {
    fila.parentNode.removeChild(fila);
  }
  

  function guardar2() {
    tr = document.getElementsByTagName("tr");
    var datos = [];
    for(i=1; i<tr.length; i++) {
        input=tr[i].getElementsByClassName("input");
        var fila=[];
        fila.push(input[0].value);//name
        fila.push(input[1].value);// type
        fila.push(input[2].value);// Authentificacion Condition
        datos.push(fila);
    }
    columnasSQL = datos;

    stringy = JSON.stringify(columnasSQL);
    localStorage.setItem("auths", stringy );

  }

  function getLocalStorage(key){
    try {
        return JSON.parse(localStorage.getItem(key))
      } catch (error) {
        return localStorage.getItem(key)
      }
  }


  // Función para guardar el contenido de la tabla en la variable global columnasSQL
  function guardarMal() {
    var filas = tabla.getElementsByTagName("tr");
    var datos = [];
  
    for (var i = 1; i < filas.length; i++) {
      var fila = filas[i];
      var celdas = fila.getElementsByTagName("td");
      var filaDatos = [];
  
      for (var j = 0; j < celdas.length - 1; j++) { // Excluir la última celda
        var input = celdas[j].getElementsByClassName("input")[0];
        filaDatos.push(input.value);
        console.log("Valor de la celda:", input.value);
      }
  
      datos.push(filaDatos);
    }
  
    columnasSQL = datos;

    stringy = JSON.stringify(columnasSQL);
    console.log("Contenido guardado en columnasSQL:", stringy); //JSON.parse
    localStorage.setItem("columnasSQL", stringy );
  }
  
  // Función para cargar los datos iniciales en la tabla
  function cargarDato(auxSQL) { // mandar [['','','',...,'']]
    /*
    if(localStorage.getItem("columnasSQL") !== null) {
        auxSQL = localStorage.getItem("columnasSQL");
    }
    */
    for (var i = 0; i < auxSQL.length; i++) {
      var fila = document.createElement("tr");
  
      for (var j = 0; j < auxSQL[i].length; j++) {
        var celda = document.createElement("td");
        var input;
  
          input = document.createElement("input");
          input.type = "text";
          input.value = auxSQL[i][j];
  
        input.classList.add("input"); // Agregar la clase "input" al elemento input o select
        celda.appendChild(input);
        fila.appendChild(celda);
      }
  
      // Agregar botón de eliminación solo en la última fila
      if (i === auxSQL.length - 1) {
        var celdaEliminar = document.createElement("td");
        var btnEliminar = document.createElement("button");
        btnEliminar.textContent = "Eliminar";
        btnEliminar.addEventListener("click", function () {
          eliminarFila(fila);
        });
        celdaEliminar.appendChild(btnEliminar);
        fila.appendChild(celdaEliminar);
      }
  
      tabla.appendChild(fila);
    }
  }
  












var auths;
  function cargarDatosIniciales(auxSQL2) {

    if(localStorage.getItem("nombreDeLaTabla")!=null) {
      nombreDeLaTabla = getLocalStorage("nombreDeLaTabla");
      document.getElementById("nombreDeLaTabla").innerHTML = nombreDeLaTabla;
    }
    //auths
    
    if(getLocalStorage("auths")!=null) {
      if(localStorage.getItem("auths")!='[]') {
        auths = getLocalStorage("auths"); 
        auxSQL = auths;
        for(let i=0; i<auths.length;i++) {
          var auxSQL3 = Array(auths[i]);
          cargarDato(auxSQL3);
        }
        return
      }
    }
    

    if(getLocalStorage("get")!=null) {
        if(getLocalStorage("get")!='[]') {
          get = getLocalStorage("get"); 
        }
    }
    if(getLocalStorage("post")!=null) {
      if(getLocalStorage("post")!='[]') {
        post = getLocalStorage("post"); 
      }
    }

    var vector = [];

    // Recorrer el array 'get'
    for (var i = 0; i < get.length; i++) {
      var palabras = get[i][3].split(",");
      for (var j = 0; j < palabras.length; j++) {
        var palabra = palabras[j].trim();
        if (!vector.includes(palabra)) {
          vector.push(palabra);
        }
      }
    }
    
    // Recorrer el array 'post'
    for (var i = 0; i < post.length; i++) {
      var palabras = post[i][4].split(",");
      for (var j = 0; j < palabras.length; j++) {
        var palabra = palabras[j].trim();
        if (!vector.includes(palabra)) {
          vector.push(palabra);
        }
      }
    }
    
    console.log(vector);

    while(auxSQL2.length<vector.length) {
      auxSQL2.push(["authUpdate","sesion","id"]);
    }

    for(let i=0; i<auxSQL2.length;i++) {
        auxSQL2[i][0] = vector[i];
        var auxSQL3 = Array(auxSQL2[i]);
        cargarDato(auxSQL3);
    }
   
  }





  // Cargar los datos iniciales al cargar la página
  cargarDatosIniciales(auxSQL);