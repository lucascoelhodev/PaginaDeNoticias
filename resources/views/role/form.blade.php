
<div class="row"> 
    <div class="col-md-4"> 
        {!!Form::text("name","Nome")->required()!!} 
    </div>  
    <div class="col-md-12"> 
        {!!Form::textarea("description","Descrição")->required()!!} 
    </div>
</div>
<button type="submit" class="btn btn-primary">Enviar</button>
