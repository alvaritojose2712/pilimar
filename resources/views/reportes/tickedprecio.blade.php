




<div class= "" id = "divEtiqueta">
<!-- 	<div class="row col-12">
		<img src = "logo.jpg" class = "log">

	</div> -->


<label class="titulo">
    
</label>
<label>
{{$codigo_barras}}
</label>
<br>
<label class="titulo" hidden>
    DESCRIPCION:
</label>
<label class= "descripcion">
{{$descripcion}}

</label>
<br>
<label class ="precio">
{{$pu}}

</label>
<label class="titulo">
    REF:
</label>

</div>





<style>
	#divEtiqueta{
        width: 57mm;
        height: 38mm;
        padding: 3px;
        overflow: hidden;
        font-family: arial;
        transform: rotate(90deg) scale(1.5);
        margin-top: 102px;
    }
    .titulo{
        width: 100%;
        font-size: 0.5rem;
        margin-bottom: -4px;
    }
    .descripcion{
        font-size: 0.7rem;
        font-weight: bold;
    }

    .precio{
        font-size: 2rem;
        font-weight: bold;
        width: 90%;
        text-align: center;
        margin-top: -10px;
        letter-spacing: 0.3rem;
        

    }


</style>

<script>

/* setTimeout(() => {

window.print();  

}, 2000);
 */




/* setTimeout(() => {

  window.close();

}, 3000);

window.onfocus = function () { setTimeout(function () { window.close(); }, 3000); }
 */
</script>
