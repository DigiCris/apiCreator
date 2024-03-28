// Datos de ejemplo
var auxDelete = [
    ["all","Deletes all "+getLocalStorage('nombreDeLaTabla')+" table"]
  ];

  // Variable global para almacenar los datos de la tabla
  var DeleteFunctions = [];
  var nombreDeLaTabla;
  
  // Obtener referencia a la tabla y al botón de agregar
  var tabla = document.getElementById("tabla");
  var btnAgregar = document.getElementById("btn-agregar");
  
  // Agregar eventos a los elementos
  btnAgregar.addEventListener("click", function() {
    //agregarFila();
    cargarDatosIniciales(auxDelete2)
  });
  
  // Función para agregar una fila a la tabla
  function agregarFila() {
    var fila = document.createElement("tr");
  
    var tiposEntrada = [
      "text", // by
      "text", // description
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
    DeleteFunctions = datos;

    stringy = JSON.stringify(DeleteFunctions);
    localStorage.setItem("DeleteFunctions", stringy );

  }

  function getLocalStorage(key){
    try {
        return JSON.parse(localStorage.getItem(key))
      } catch (error) {
        return localStorage.getItem(key)
      }
  }


  
  // Función para cargar los datos iniciales en la tabla
  function cargarDato(auxDelete) { 
    for (var i = 0; i < auxDelete.length; i++) {
      var fila = document.createElement("tr");
  
      for (var j = 0; j < auxDelete[i].length; j++) {
        var celda = document.createElement("td");
        var input;
  
          input = document.createElement("input");
          input.type = "text";
          input.value = auxDelete[i][j];
  
        input.classList.add("input"); // Agregar la clase "input" al elemento input o select
        celda.appendChild(input);
        fila.appendChild(celda);
      }
  
      // Agregar botón de eliminación solo en la última fila
      if (i === auxDelete.length - 1) {
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
  




  function crearDeleteCombinations() {
    var columnas;
    if(getLocalStorage("columnas")!=null) {
      if(localStorage.getItem("columnas")!='[]') {
        columnas = getLocalStorage("columnas"); // generar auxDelete = [ ["all","id"], ];
      } else {
        return;
      }
    }else {
      return
    }

    columnas.forEach(function(columna) {
      auxDelete.push([columna[1],"delete all that matches " + columna[1] + " in " + getLocalStorage('nombreDeLaTabla')]);
      //i++;
      //post[i] = ["delete", "", columna[1], "delete all that matches " + columna[1] + " in " + tabla, "authDel", columna[1]]; // postBy...
    });
  
    return auxDelete;
  }




  function cargarDatosIniciales(auxDelete2) {

    if(localStorage.getItem("nombreDeLaTabla")!=null) {
      nombreDeLaTabla = getLocalStorage("nombreDeLaTabla");
      document.getElementById("nombreDeLaTabla").innerHTML = nombreDeLaTabla;
    }

    if(getLocalStorage("DeleteFunctions")!=null) {
      if(localStorage.getItem("DeleteFunctions")!='[]') {
        auxDelete2 = getLocalStorage("DeleteFunctions"); 
        auxDelete = auxDelete2;
      }
    }
    
    for(let i=0; i<auxDelete2.length;i++) {
        var auxDelete3 = Array(auxDelete2[i]);
        cargarDato(auxDelete3);
    }
   
  }





  // Cargar los datos iniciales al cargar la página
  crearDeleteCombinations()
  cargarDatosIniciales(auxDelete);