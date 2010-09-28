<html>
<head>
<script language="javascript" type="text/javascript">
    noticiero=new Array();

    // Pon las noticias de la siguiente forma: new noticia(imagen, titulo,texto,enlace)

    noticiero[0]=new noticia("pepe.jpg","Nombres","Carlos Carlos Carlos Carlos Carlos Carlos Carlos Carlos Carlos Carlos Carlos Carlos","http://www.google.es");
    noticiero[1]=new noticia("jojo.jpg","Aqui estamos","Aqu&iacute; estamos todos.  Aqu&iacute; estamos todos.  Aqu&iacute; estamos todos.  Aqu&iacute; estamos todos.  Aqu&iacute; estamos todos.  Aqu&iacute; estamos todos.  Aqu&iacute; estamos todos.  Aqu&iacute; estamos todos.  ","http://www.google.es");
    //noticiero[2]=...

    espera=2 //Segundos de espera

    function noticia(imagen,titulo,texto,enlace){
        this.imagen=imagen;
        this.texto=texto;
        this.titulo=titulo
        this.enlace=enlace
    }
    
    function obj(x){
        return document.getElementById(x);
    }

    function mostrar(a){
        obj("imagen_noticia").src=noticiero[a].imagen;
        obj("titulo_noticia").innerHTML=noticiero[a].titulo;
        obj("texto_noticia").innerHTML=noticiero[a].texto;
        obj("enlace").href=noticiero[a].enlace
    }
    b=0;
    function cambiar(){
        b=(noticiero.length-1>b)?b+1:0;
        mostrar(b);
    }



    setInterval("cambiar()",espera*1000);

</script>
<style>
#imagen_noticia{
float:left;
}
</style>
<title>Untitled</title>
</head>

<body onload="mostrar(0);">
<div id="cuadro">
<img src="" id="imagen_noticia" />
<h1 id="titulo_noticia"></h1>
<p id="texto_noticia"></p>
<a href="#" id="enlace">leer m&aacute;s</a>
</div>


</body>
</html>