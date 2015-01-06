// LLAMA EL CAMPO <input tyupe='text' onkeypress='return numeros(event);'
function siestudia(){
	if (document.fvalida.txtestudia.checked==true){
		document.fvalida.Txtdonde.disabled=false;	
	}else{
		document.fvalida.Txtdonde.disabled=true;	
	}
}

function aleatorio(inferior,superior){
    numPosibilidades = superior - inferior;
    aleat = Math.random() * numPosibilidades;
    aleat = Math.round(aleat);
    numero = parseInt(inferior) + aleat;
	cadena = "RandomImage("+numero+").jpg"
	return cadena;
	//alert(cadena);
	
} 

//Funcion que obliga a insertar solo letras
function letras(e) { // 1
tecla = (document.all) ? e.keyCode : e.which; // 2
if (tecla==8) return true; // 3
patron =/[A-Za-z\s]/; // 4
te = String.fromCharCode(tecla); // 5
return patron.test(te); // 6
} 

//funcion validar letras y numeros
function letras_numer(e) { // 1
tecla = (document.all) ? e.keyCode : e.which; // 2
if (tecla==8) return true; // 3
patron =/[A-Za-z\s0-9]/; // 4
te = String.fromCharCode(tecla); // 5
return patron.test(te); // 6
} 


//funcion que obliga a insertar solo numeros CON PUNTO /[0-9.]/ SIN PUNTO /[0-9]/ CAMBIAR EL PARAMETRO
function IsNumber(evt){
tecla = (document.all) ? e.keyCode : e.which; // 2
if (tecla==8) return true; // 3
patron = /\d/; // Solo acepta números// 4
te = String.fromCharCode(tecla); // 5
return patron.test(te); // 6
}

function numeros(e) { // 1
tecla = (document.all) ? e.keyCode : e.which; // 2
if (tecla==8) return true; // 3
patron = /[0-9]/; // Solo acepta números// 4
te = String.fromCharCode(tecla); // 5
return patron.test(te); // 6
} 

function validarEntero(valor){ 
     
		//intento convertir a entero. 
     //si era un entero no le afecta, si no lo era lo intenta convertir 
     valor = parseInt(valor) 

     	//Compruebo si es un valor numérico 			
     	if (isNaN(valor) || (valor==9)) { 
           	 //entonces (no es numero) devuelvo el valor cadena vacia 
           	 return ""; 
     	}else{ 
           	 //En caso contrario (Si era un número) devuelvo el valor 
           	 return valor; 
     	} 
}

function validarSiNumero(numero){
if (!/^([0-9])*$/.test(numero))
alert("El valor " + numero + " no es un número");
}

//funcion que valida el celular
function valida_cedula(){
	cedula = document.fvalida.txtcedula.value; 
   	cedula = validarEntero(cedula); 
   	document.fvalida.txtcedula.value=cedula; 
	if (cedula==""){ 
      	 document.fvalida.txtcedula.focus(); 
	
     	 return 0; 
   	}
	if(document.fvalida.txtcedula.value.length>8){ 
      	 alert("La cedula debe contener hasta 8 digitos") 
      	 document.fvalida.txtcedula.focus() 

      	 return 0; 
   	} 
	return 1;
}

//funcion que valida el nombre
function valida_nombre(){
	if (document.fvalida.txtnombre.value.length==0){ 
      	 alert("Debe ingresar su nombre") 
      	 document.fvalida.txtnombre.focus() 
      	 return 0; 
   	} 
}

//funcion que valida el apellido
function valida_apellido(){
	if (document.fvalida.txtapellido.value.length==0){ 
      	 alert("Debe ingresar su apellido") 
      	 document.fvalida.txtapellido.focus() 
      	 return 0; 
   	}
}

//funcion que valida el direccion
function valida_direccion(){
	if (document.fvalida.txtdireccion.value.length==0){ 
      	 alert("Debe ingresar su dirección") 
      	 document.fvalida.txtdireccion.focus() 
      	 return 0; 
   	}
}

//funcion validacion de correos
function valida_correos(){
	if (document.fvalida.txtcorreo1.value.indexOf('@', 0) == -1 || document.fvalida.txtcorreo1.value.indexOf('.', 0) == -1){ 
	 	alert("Dirección de e-mail inválida"); document.fvalida.txtcorreo1.focus(); 
		return 0; 
	}
	
	if (document.fvalida.txtcorreo2.value.indexOf('@', 0) == -1 || document.fvalida.txtcorreo2.value.indexOf('.', 0) == -1){ 
	 	alert("Dirección de e-mail de confirmación inválida"); document.fvalida.txtcorreo2.focus(); 
		return 0; 
	}
	correo1=document.fvalida.txtcorreo1.value;
	correo2=document.fvalida.txtcorreo2.value;
	if(correo1!=correo2){
		alert("Dirección de e-mail de confirmación debe coincidir"); document.fvalida.txtcorreo2.focus(); 
		return 1;
	}
}



function valida_telefono(){
	numero = document.fvalida.txttelefono.value; 
   	numero = validarEntero(numero); 
   	document.fvalida.txttelefono.value=numero; 
	if (cedula==""){ 
      	 document.fvalida.txttelefono.focus(); 
     	 return 0; 
   	}
	if(document.fvalida.txttelefono.value.length<7){ 
      	 alert("El número de telefono debe contener 7 digitos") 
      	 document.fvalida.txttelefono.focus() 
      	 return 0; 
   	}
	if(document.fvalida.txttelefono.value.length==0){ 
      	 alert("Debe ingresar su numero telefonico") 
      	 document.fvalida.apellido.focus() 
      	 return 0; 
   	}
}

function valida_celular(){
numero = document.fvalida.txtcelular.value; 
   	numero = validarEntero(numero); 
   	document.fvalida.txtcelular.value=numero; 
	if (cedula==""){
      	 document.fvalida.txtcelular.focus(); 
     	 return 0; 
   	}
	if(document.fvalida.txtcelular.value.length<7){ 
      	 alert("El número de celular debe contener 7 digitos") 
      	 document.fvalida.txtcelular.focus() 
      	 return 0; 
   	}
	if(document.fvalida.txtcelular.value.length==0){ 
      	 alert("Debe ingresar su numero telefonico") 
      	 document.fvalida.txtcelular.focus() 
      	 return 0; 
   	}
	 
}

//valida si estudi
function estudia(){
	if(document.fvalida.estudia.values=2){
		document.fvalida.Txtdonde.eneable=true;
	}
}
//Funcion Global de validacion 
function valida_envia(){ 
	eval=valida_cedula();
	if (eval==0){
		alert("El formulario esta completamente vacio, por favor ingrese sus datos");
	}else{
		valida_nombre();
		valida_apellido();
		valida_correos();
		valida_telefono();
		valida_celular();
		valida_direccion();
		eval=1;
	}  	
 
	if (eval>0){
		alert("Muchas gracias por enviar el formulario"); 
   		document.fvalida.submit();
	} 
}

function fecha(){
	if(fecha=document.fvalida.testinput.value==""){
		alert("Debe ingresar su fecha de nacimiento") 
      	 document.fvalida.testinput.focus() 
      	 return 0; 
	}
	
	var fecha=new Date();
	var actual=fecha.getFullYear();
	usuario=document.fvalida.testinput.value;
	var ano2=usuario.substring(6,10);
	fechaactual=parseInt(actual);
	fechausuario=parseInt(ano2);
	if((fechaactual-fechausuario<18)||(fechaactual-fechausuario>24)){
		alert("Su edad no está entre el rango permitido");
	}
	
}

function valida_num(numero, nombre){
	if ((numero < 1) || (numero >20)){ 
      	 alert("La nota debe estar entre 1 y 20 puntos");
		 document.getElementById(nombre).value = "";
      	 //return 0;
   	}
}

