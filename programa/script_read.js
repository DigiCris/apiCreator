// Datos de ejemplo
var auxRead = [
    ["all","Reads all "+getLocalStorage('nombreDeLaTabla')+" table"]
  ];

  // Variable global para almacenar los datos de la tabla
  var ReadFunctions = [];
  
  // Obtener referencia a la tabla y al botón de agregar
  var tabla = document.getElementById("tabla");
  var btnAgregar = document.getElementById("btn-agregar");
  
  // Agregar eventos a los elementos
  btnAgregar.addEventListener("click", function() {
    //agregarFila();
    cargarDatosIniciales(auxRead2)
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
    ReadFunctions = datos;

    stringy = JSON.stringify(ReadFunctions);
    localStorage.setItem("ReadFunctions", stringy );

    crearHandler();

  }

  function getLocalStorage(key){
    try {
        return JSON.parse(localStorage.getItem(key))
      } catch (error) {
        return localStorage.getItem(key)
      }
  }

  var Update;
  var Read = [];
  var Delete = [];
  var login = [];
  var claves=[];
  function crearHandler() {

    // login, claves para RSA, y nombres de las bases de datos hacerlos luego en otra pestaña
    
    localStorage.setItem("update", localStorage.getItem("UpdateFunctions") )
    Update = getLocalStorage("Update");

    deleteAux = getLocalStorage("DeleteFunctions");
    for(i=0;i<deleteAux.length;i++) {
      Delete[i] = deleteAux[i][0];
    }
    stringy = JSON.stringify(Delete);
    localStorage.setItem("Delete", stringy );

    readAux = getLocalStorage("ReadFunctions");
    for(i=0;i<readAux.length;i++) {
      Read[i] = readAux[i][0];
    }
    stringy = JSON.stringify(Read);
    localStorage.setItem("Read", stringy );

    // Handler pide login (campo user, password y encriptacion), y partes que se borran si existe el rsa

    user = prompt("Variable que usara como usuario de login "+stringy+": ");
    password = prompt("Variable que usara como password de login "+stringy+": ");
    encryption = prompt("Cual es el metodo de encriptacion que usará? PASSWORD_BCRYPT?");
    if(encryption=="") {
      encryption = "PASSWORD_BCRYPT";
    }
    login[0] = user;
    login[1] = password;
    login[2] = encryption;
    stringy = JSON.stringify(login);
    localStorage.setItem("login", stringy );



// Generar una clave RSA de 2048 bits
var rsaKeyPair = forge.pki.rsa.generateKeyPair({ bits: 2048 });

// Obtener las claves privada y pública en formato PEM
var privateKeyPem = forge.pki.privateKeyToPem(rsaKeyPair.privateKey);
var publicKeyPem = forge.pki.publicKeyToPem(rsaKeyPair.publicKey);

claves[0] = privateKeyPem;
claves[1] = publicKeyPem;
claves[2] = prompt("entre 40 y 500. El - dice de donde hasta donde saca y ; separa claves. Siempre sacará una letra más que la resta que haga de ambos numeros separados por . Ejemplo = 40-46;200-205;494-500");
stringy = JSON.stringify(claves);
localStorage.setItem("claves", stringy );


// lib no pide nada
source = "./"+getLocalStorage("nombreDeLaTabla");
destination = "api/v1/"+getLocalStorage("nombreDeLaTabla");
stringy = JSON.stringify(source);
localStorage.setItem("source", stringy );
stringy = JSON.stringify(destination);
localStorage.setItem("destination", stringy );


// config pide nombres de las bases de datos
DBNAME = prompt("DBNAME = NOMBRE de la base de datos.");
DBUSER = prompt("DBUSER = nombre de USUARIO de la base de datos.");
DBPASSWD = prompt("DBPASSWD = PASSWORD de la base de datos.");
stringy = JSON.stringify(DBNAME);
localStorage.setItem("DBNAME", stringy );
stringy = JSON.stringify(DBUSER);
localStorage.setItem("DBUSER", stringy );
stringy = JSON.stringify(DBPASSWD);
localStorage.setItem("DBPASSWD", stringy );

  }

  
  // Función para cargar los datos iniciales en la tabla
  function cargarDato(auxRead,readOnly) { 
    for (var i = 0; i < auxRead.length; i++) {
      var fila = document.createElement("tr");
  
      for (var j = 0; j < auxRead[i].length; j++) {
        var celda = document.createElement("td");
        var input;
  
          input = document.createElement("input");
          input.type = "text";
          input.value = auxRead[i][j];
  
        input.classList.add("input"); // Agregar la clase "input" al elemento input o select
        if(j==0) {
          input.readOnly = !readOnly; // agregado btnEliminar.disabled = true;
        }
        celda.appendChild(input);
        fila.appendChild(celda);
      }
  
      // Agregar botón de eliminación solo en la última fila
      if (i === auxRead.length - 1) {
        var celdaEliminar = document.createElement("td");
        var btnEliminar = document.createElement("button");
        btnEliminar.textContent = "Eliminar";
        btnEliminar.addEventListener("click", function () {
          eliminarFila(fila);
        });
        btnEliminar.disabled = !readOnly; // agregado btnEliminar.disabled = true;
        celdaEliminar.appendChild(btnEliminar);
        fila.appendChild(celdaEliminar);
      }
  
      tabla.appendChild(fila);
    }
  }
  



  var nonErrasable = [];
  function crearReadCombinations() {
    var columnas;
    if(getLocalStorage("columnas")!=null) {
      if(localStorage.getItem("columnas")!='[]') {
        columnas = getLocalStorage("columnas"); // generar auxRead = [ ["all","id"], ];
      } else {
        return;
      }
    }else {
      return
    }


    columnas.forEach(function(columna) {
      auxRead.push([columna[1],"Read all that matches " + columna[1] + " in " + getLocalStorage('nombreDeLaTabla')]);
    });
  
    return auxRead;
  }




  function cargarDatosIniciales(auxRead2,nonErrasable) {

    if(localStorage.getItem("nombreDeLaTabla")!=null) {
      nombreDeLaTabla = getLocalStorage("nombreDeLaTabla");
      document.getElementById("nombreDeLaTabla").innerHTML = nombreDeLaTabla;
    }

    if(getLocalStorage("ReadFunctions")!=null) {
      if(localStorage.getItem("ReadFunctions")!='[]') {
        auxRead2 = getLocalStorage("ReadFunctions"); 
        auxRead = auxRead2;
      }
    }


    var WriteFunctions = getLocalStorage("WriteFunctions");
    var UpdateFunctions = getLocalStorage("UpdateFunctions");
    var DeleteFunctions = getLocalStorage("DeleteFunctions");
    let i=0;

    auxRead.forEach(function(fila) {
      nonErrasable.push(false);
      WriteFunctions.forEach(function(writef) {
        if(writef[1].trim().toLowerCase()==fila[0]){
          nonErrasable[nonErrasable.length-1] |= true;
        }
      });
      UpdateFunctions.forEach(function(updatef) {
        if(updatef[1].trim().toLowerCase()==fila[0]){
          nonErrasable[nonErrasable.length-1] |= true;
        }
      });
      DeleteFunctions.forEach(function(deletef) {
        if(deletef[0].trim().toLowerCase()==fila[0]){
          nonErrasable[nonErrasable.length-1] |= true;
        }
      });
    });


    
    for(let i=0; i<auxRead2.length;i++) {
        var auxRead3 = Array(auxRead2[i]);
        cargarDato(auxRead3,nonErrasable[i]);
    }
   
  }


  function generarArchivoPHP() {
    var variables = Object.keys(localStorage);
    var variablesIndividuales = [];
    var variablesVectores = [];
  
    // Separar variables individuales y vectores
    variables.forEach(function (variable) {
      var valor = localStorage.getItem(variable);
      try {
        JSON.parse(valor);
        variablesIndividuales.push(variable);
      } catch (error) {
        variablesVectores.push(variable);
      }
    });
  
    // Generar contenido PHP
    var contenidoPHP = "<?php\n";
    variablesIndividuales.forEach(function (variable) {
      var nombreVariablePHP = variable.charAt(0).toLowerCase() + variable.slice(1);
      if(nombreVariablePHP=="readFunctions" || nombreVariablePHP=="writeFunctions" || nombreVariablePHP=="updateFunctions" || nombreVariablePHP=="deleteFunctions" ) {
          nombreVariablePHP = nombreVariablePHP.toUpperCase();
      }
      var valor = localStorage.getItem(variable);
      contenidoPHP += "$" + nombreVariablePHP + " = " + valor + ";\n";
    });
    variablesVectores.forEach(function (variable) {
      var nombreVariablePHP = variable.charAt(0).toLowerCase() + variable.slice(1);
      var valor = JSON.stringify(localStorage.getItem(variable));
      contenidoPHP += "$" + nombreVariablePHP + " = " + valor + ";\n";
    });
    contenidoPHP += "?>";
  
    // Crear archivo PHP
    var enlaceDescarga = document.createElement("a");
    var archivo = new Blob([contenidoPHP], { type: "text/plain" });
    enlaceDescarga.href = URL.createObjectURL(archivo);
    enlaceDescarga.download = "configvars.php";
    enlaceDescarga.click();
  }
  


  // Cargar los datos iniciales al cargar la página
  crearReadCombinations()
  cargarDatosIniciales(auxRead,nonErrasable);