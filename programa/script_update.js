// Datos de ejemplo
var auxUpdate = [
    ["all","id"]
  ];

  // Variable global para almacenar los datos de la tabla
  var UpdateFunctions = [];
  
  // Obtener referencia a la tabla y al botón de agregar
  var tabla = document.getElementById("tabla");
  var btnAgregar = document.getElementById("btn-agregar");
  
  // Agregar eventos a los elementos
  btnAgregar.addEventListener("click", function() {
    //agregarFila();
    cargarDatosIniciales(auxUpdate2)
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
    UpdateFunctions = datos;

    stringy = JSON.stringify(UpdateFunctions);
    localStorage.setItem("UpdateFunctions", stringy );

  }

  function getLocalStorage(key){
    try {
        return JSON.parse(localStorage.getItem(key))
      } catch (error) {
        return localStorage.getItem(key)
      }
  }


  
  // Función para cargar los datos iniciales en la tabla
  function cargarDato(auxUpdate) { // mandar [['','','',...,'']]
    /*
    if(localStorage.getItem("UpdateFunctions") !== null) {
        auxUpdate = localStorage.getItem("UpdateFunctions");
    }
    */
    for (var i = 0; i < auxUpdate.length; i++) {
      var fila = document.createElement("tr");
  
      for (var j = 0; j < auxUpdate[i].length; j++) {
        var celda = document.createElement("td");
        var input;
  
          input = document.createElement("input");
          input.type = "text";
          input.value = auxUpdate[i][j];
  
        input.classList.add("input"); // Agregar la clase "input" al elemento input o select
        celda.appendChild(input);
        fila.appendChild(celda);
      }
  
      // Agregar botón de eliminación solo en la última fila
      if (i === auxUpdate.length - 1) {
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
  




  function crearUpdateCombinations() {
    var columnas;
    if(getLocalStorage("columnas")!=null) {
      if(localStorage.getItem("columnas")!='[]') {
        columnas = getLocalStorage("columnas"); // generar auxUpdate = [ ["all","id"], ];
      } else {
        return;
      }
    }else {
      return
    }

    var post = [];
    var i = 0;
  
    columnas.forEach(function(columna) {
      i++;
      if(i==1) {
        auxUpdate[0][0] = "all";
        auxUpdate[0][1] = columna[1];
      } else {
        auxUpdate.push(["all", columna[1]]);
      }
      //post[i] = ["update", "all", columna[1], "Updates all that matches " + columna[1] + " in " + tabla, "authUpdate", columna[1]]; // postBy...
    });
  
    columnas.forEach(function(columna) {
      columnas.forEach(function(fila) {
        if (fila[1] !== columna[1]) {
            if( (columna[3].trim().toLowerCase()!=="autoincremental") && (columna[3].trim().toLowerCase() !== "increment") && (columna[3].trim().toLowerCase() !== "inc") ) {
                auxUpdate.push([columna[1],fila[1]]);
                //post[i] = ["update", columna[1], fila[1], "Updates " + columna[1] + " that matches " + fila[1] + " in " + tabla, "authUpdate", columna[1] + "," + fila[1]];                
            }

        }
      });
    });
  
    return auxUpdate;
  }




  function cargarDatosIniciales(auxUpdate2) {

    if(localStorage.getItem("nombreDeLaTabla")!=null) {
      nombreDeLaTabla = getLocalStorage("nombreDeLaTabla");
      document.getElementById("nombreDeLaTabla").innerHTML = nombreDeLaTabla;
    }

    if(getLocalStorage("UpdateFunctions")!=null) {
      if(localStorage.getItem("UpdateFunctions")!='[]') {
        auxUpdate2 = getLocalStorage("UpdateFunctions"); 
        auxUpdate = auxUpdate2;
      }
    }
    
    for(let i=0; i<auxUpdate2.length;i++) {
        var auxUpdate3 = Array(auxUpdate2[i]);
        cargarDato(auxUpdate3);
    }
   
  }





  // Cargar los datos iniciales al cargar la página
  crearUpdateCombinations()
  cargarDatosIniciales(auxUpdate);