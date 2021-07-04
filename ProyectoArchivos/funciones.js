

var posicion = 0;
var divSlid;
var divsImgs;
var nav;
var bandSegu = true;
var repeticion;
var p;
var cadNav="";
var arrNav = [];

var divNav;
var divsNaNums;
var tiempo = 3000;
var rapi;

var dirImg = "Imagenes/";

function iniDatos()
{
	divSlid = document.getElementById("sliders");
	divsImgs = divSlid.getElementsByTagName("div");
	divSlid.style.backgroundImage = 'url('+dirImg+divsImgs[0].id+'.jpg)';
	
	
	
	
	for(i =0 ; i< divsImgs.length;i++)
	{
		if(0!=i)
		divsImgs[i].style.opacity = "0";
	}
	
	divsImgs[0].style.opacity = "1";
	
}

function inicializa(x)
{


	for(i =0 ; i< divsImgs.length;i++)
		{
			 if(x == i)
			 {
			 	divsImgs[i].style.opacity = "1";
			 	divSlid.style.backgroundImage = 'url('+dirImg+divsImgs[i].id+'.jpg)';
			 	divsNaNums[i].style.backgroundColor = "#1279BB";
			 }
			 else
			 {
			 	divsImgs[i].style.opacity = "0";
			 	divsNaNums[i].style.backgroundColor = "transparent"; 	
			 }
		}
		posicion = x;
		if(x  == (divsImgs.length-1))
		{
			x  = 0;
		}
		else
		{
			x ++;
		}

		
	repeticion = setInterval(function()
 	{ 
 		
 		for(j =0 ; j< divsImgs.length;j++)
		{
			 if(x == j)
			 {
			 	divsImgs[j].style.opacity = "1";
			 	divSlid.style.backgroundImage = 'url('+dirImg+divsImgs[j].id+'.jpg)';
			 	divsNaNums[j].style.backgroundColor = "#1279BB";
			 }
			 else
			 {
			 	divsImgs[j].style.opacity = "0";
			 	divsNaNums[j].style.backgroundColor = "transparent"; 	
			 }
		}
		
		posicion = x;
		
		
		if(x  == (divsImgs.length-1))
		{
			x  = 0;
		}
		else
		{
			x ++;
		}
		
						
 	}, 3000);
 	
}


function izquierda()
{
	
	clearInterval(repeticion);
	
	if((posicion-1) == -1)
		posicion = (divsImgs.length-1);
	else
		posicion--;
	
	inicializa(posicion);
	

	
}

function derecha()
{
	clearInterval(repeticion);
	
	if((posicion+1) == divsImgs.length)
	{
		posicion = 0;
	}
	else
	{
		posicion++;
	}
	
	inicializa(posicion);
	

}	


function iniNave()
{
   
	for(i =0 ; i< divsImgs.length;i++)
	{		
		arrNav[i] = i+1;
	}


	for(i =0 ; i< divsImgs.length;i++)
	{		
		cadNav += "<div onclick=\"identificar('"+arrNav[i]+"')\"  id=\""+arrNav[i]+"\"><a href='#'>"+arrNav[i]+"</a></div>";
	}
	
	nav = document.getElementById("numerosNave");	
	divsNaNums = nav.getElementsByTagName("div");
	nav = document.getElementById("numerosNave").innerHTML= cadNav;
	
}

function identificar(c)
{
	var re = document.getElementById(c);
	clearInterval(repeticion);
	posicion = c-1;
	inicializa(posicion);
}


/*Funciones de registrarse*/

function VerificarFRMReg()
{
	if(document.getElementById("txtPassword").value != document.getElementById("txtPassword2").value)
	{
		alert("contraseñas no coniciden");
		return false;
	}
	else
		if( document.getElementById("txtNombre").value != "" && document.getElementById("txtUsuario").value != "" && document.getElementById("txtPassword").value != ""
		&& document.getElementById("txtPassword2").value != "")
		{
			alert("aceptado");
			return true;
		}
		else
		{
			alert("Hay campos vacios");
			return false;
		}		
}

/*Funciones de Autenticarse*/

function VerificarFRMAute()
{
if(document.getElementById("txtUsuario").value == "")
	{
		alert("El nombre del usaurio no se puede opmitir");
		return false;
	}
	else
	if(document.getElementById("txtPassword").value == "")
	{
		alert("El password del usaurio no se puede opmitir");
		return false;
	}
	else
	return true;

}




