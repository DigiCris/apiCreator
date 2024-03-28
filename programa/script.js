// Datos de ejemplo
var auxSQL = [
    ["id", "INT", 11, null, false, true, "autoincremental | 1 unique id for each webinar/news.", true]
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
        
        if (tiposEntrada[i] === "select") {
          input = document.createElement("select");
          input.innerHTML = '<option value="INT">INT</option><option value="VARCHAR">VARCHAR</option><option value="DATE">DATE</option>'; // Opciones para el campo select
        } else {
          input = document.createElement("input");
          input.type = tiposEntrada[i];
        }
        
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
        fila.push(input[2].value);// length
        fila.push(input[3].value);// default value
        fila.push(input[4].checked);// nullable
        fila.push(input[5].checked); // autoincrement
        fila.push(input[6].value); // description
        fila.push(input[7].checked); // primary
        datos.push(fila);
    }
    columnasSQL = datos;

    stringy = JSON.stringify(columnasSQL);
    localStorage.setItem("columnasSQL", stringy );

    localStorage.setItem("nombreDeLaTabla", nombreDeLaTabla );

    columnas = crearColumnas(columnasSQL);
    stringy = JSON.stringify(columnas);
    localStorage.setItem("columnas", stringy );

    get = crearGetCombinations(columnas, nombreDeLaTabla);
    stringy = JSON.stringify(get);
    localStorage.setItem("get", stringy );

    post = crearPostCombinations(columnas, nombreDeLaTabla);
    stringy = JSON.stringify(post);
    localStorage.setItem("post", stringy );
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
  
        if (j === 1) { // Para la columna $tipo
          input = document.createElement("select");
          input.innerHTML = '<option value="INT">INT</option><option value="VARCHAR">VARCHAR</option><option value="DATE">DATE</option>'; // Opciones para el campo select
          input.value = auxSQL[i][j];
        } else if (j === 4 || j === 5 || j === 7) { // Para las columnas $nulo, $autoincremental, $primary (checkbox)
          input = document.createElement("input");
          input.type = "checkbox";
          input.checked = auxSQL[i][j];
        } else {
          input = document.createElement("input");
          input.type = "text";
          input.value = auxSQL[i][j];
        }
  
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
  

  function cargarDatosIniciales(auxSQL2) {
    if(localStorage.getItem("columnasSQL")!=null) {
        if(localStorage.getItem("columnasSQL")!='[]') {
           auxSQL2 = JSON.parse(localStorage.getItem("columnasSQL")); 
        }
    }
    if(localStorage.getItem("nombreDeLaTabla")!=null) {
        nombreDeLaTabla = getLocalStorage("nombreDeLaTabla");
        document.getElementById("nombreDeLaTabla").innerHTML = nombreDeLaTabla;
    }
    for(let i=0; i<auxSQL2.length;i++) {
        console.log(i);
        var auxSQL3 = Array(auxSQL2[i]);
        cargarDato(auxSQL3);
    }
  }












  function crearColumnas(columnasSQL) {
    var columnas = [];
    var i = 0;
  
    columnasSQL.forEach(function(columna) {
      columnas[i] = [];
  
      var array = columna[6].split("|");
      var specialCharacteristic, description;
  
      if (array.length > 1) {
        specialCharacteristic = array[0];
        description = array[1];
      } else {
        specialCharacteristic = "";
        description = array[0];
      }
  
      columnas[i][0] = description;
      columnas[i][1] = columna[0];
      columnas[i][2] = columna[1];
      columnas[i][3] = specialCharacteristic;
  
      i++;
    });
  
    return columnas;
  }


  function crearGetCombinations(columnas, tabla) {
    var get = [];
    var i = 0;
  
    get[i] = ["all", "", "Read all " + tabla, "auth0"]; // getAll
  
    columnas.forEach(function(columna) {
      i++;
      get[i] = ["", columna[1], "Read " + tabla + " by " + columna[1] + ".", "auth"]; // getBy...
    });
  
    return get;
  }

  function crearPostCombinations(columnas, tabla) {
    var post = [];
    var i = 0;
  
    post[i] = ["set", "all", "", "Insert a new row in " + tabla, "authSet,authProc", ""]; // postAll
    i++;
    post[i] = ["delete", "all", "", "delete all table in " + tabla, "authDel", ""]; // postAll
  
    columnas.forEach(function(columna) {
      i++;
      post[i] = ["delete", "", columna[1], "delete all that matches " + columna[1] + " in " + tabla, "authDel", columna[1]]; // postBy...
    });
  
    columnas.forEach(function(columna) {
      i++;
      post[i] = ["update", "all", columna[1], "Updates all that matches " + columna[1] + " in " + tabla, "authUpdate", columna[1]]; // postBy...
    });
  
    columnas.forEach(function(columna) {
      columnas.forEach(function(fila) {
        if (fila[1] !== columna[1]) {
            if( (columna[3].trim().toLowerCase()!=="autoincremental") && (columna[3].trim().toLowerCase() !== "increment") && (columna[3].trim().toLowerCase() !== "inc") ) {
                i++;
                post[i] = ["update", columna[1], fila[1], "Updates " + columna[1] + " that matches " + fila[1] + " in " + tabla, "authUpdate", columna[1] + "," + fila[1]];                
            }

        }
      });
    });
  
    return post;
  }







  // Cargar los datos iniciales al cargar la página
  cargarDatosIniciales(auxSQL);