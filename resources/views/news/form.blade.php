<div class="row"> 
    <div class="col-md-4"> 
        {!!Form::text("title","Título")->required()!!} 
    </div> 
    <div class="col-md-4">
        {!!Form::text("author","Autor")->required()!!} 
    </div> 
    <div class="col-md-12"> 
        {!!Form::text("content","Conteúdo")->required()!!} 
    </div>
</div>
<button type="submit" class="btn btn-primary">Enviar</button>
<div class="col-md-12"></div>