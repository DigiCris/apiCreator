// Datos de ejemplo
var auxWrite = [
    ["setComplete", "id"],
  ];

  // Variable global para almacenar los datos de la tabla
  var WriteFunctions = [];
  
  // Obtener referencia a la tabla y al botón de agregar
  var tabla = document.getElementById("tabla");
  var btnAgregar = document.getElementById("btn-agregar");
  
  // Agregar eventos a los elementos
  btnAgregar.addEventListener("click", function() {
    //agregarFila();
    cargarDatosIniciales(auxWrite2)
  });
  
  // Función para agregar una fila a la tabla
  function agregarFila() {
    var fila = document.createElement("tr");
  
    var tiposEntrada = [
      "text", // nombre
      "text", // Unique Variable
    ];
  
    for (var i = 0; i < 2; i++) {
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
        fila.push(input[1].value);// Unique Variable
        datos.push(fila);
    }
    WriteFunctions = datos;

    stringy = JSON.stringify(WriteFunctions);
    localStorage.setItem("WriteFunctions", stringy );

  }

  function getLocalStorage(key){
    try {
        return JSON.parse(localStorage.getItem(key))
      } catch (error) {
        return localStorage.getItem(key)
      }
  }


  
  // Función para cargar los datos iniciales en la tabla
  function cargarDato(auxWrite) { // mandar [['','','',...,'']]
    /*
    if(localStorage.getItem("WriteFunctions") !== null) {
        auxWrite = localStorage.getItem("WriteFunctions");
    }
    */
    for (var i = 0; i < auxWrite.length; i++) {
      var fila = document.createElement("tr");
  
      for (var j = 0; j < auxWrite[i].length; j++) {
        var celda = document.createElement("td");
        var input;
  
          input = document.createElement("input");
          input.type = "text";
          input.value = auxWrite[i][j];
  
        input.classList.add("input"); // Agregar la clase "input" al elemento input o select
        celda.appendChild(input);
        fila.appendChild(celda);
      }
  
      // Agregar botón de eliminación solo en la última fila
      if (i === auxWrite.length - 1) {
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
  








  function cargarDatosIniciales(auxWrite2) {

    if(localStorage.getItem("nombreDeLaTabla")!=null) {
      nombreDeLaTabla = getLocalStorage("nombreDeLaTabla");
      document.getElementById("nombreDeLaTabla").innerHTML = nombreDeLaTabla;
    }

    if(getLocalStorage("WriteFunctions")!=null) {
      if(localStorage.getItem("WriteFunctions")!='[]') {
        auxWrite2 = getLocalStorage("WriteFunctions"); 
        auxWrite = auxWrite2;
      }
    }
    
    for(let i=0; i<auxWrite2.length;i++) {
        var auxWrite3 = Array(auxWrite2[i]);
        cargarDato(auxWrite3);
    }
   
  }





  // Cargar los datos iniciales al cargar la página
  cargarDatosIniciales(auxWrite);