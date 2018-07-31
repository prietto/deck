/*=====2010/09/21========================================================>>>>
DESCRIPCION: 	Metodo para mostrar y ocultar una tabla especifica
---------------------------------------------------------------------------					
PARAMETRO		DESCRIPCION 
node			chekbox principal
===========================================================================*/
function f_mostrar_ocultar(id_mostrar, id_ocultar){
	obj					=	document.getElementById(id_mostrar);
	obj2				=	document.getElementById(id_ocultar);	
	obj.style.display 	= 	"table";
	obj2.style.display 	= 	"none";	
}