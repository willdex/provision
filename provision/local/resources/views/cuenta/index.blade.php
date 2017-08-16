@extends ('layouts.inicio')
@section ('contenido')

@include('cuenta.modal')

@include('alerts.errors')
@include('alerts.cargando')
@if(Session::has('message'))

<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('message')}}
</div>
@endif
<style>
    ul{
        list-style: none;

    }
</style>

<?php
$tree = new arbol;
$elements = $tree->get();
$masters = $elements["masters"];
$childrens = $elements["childrens"];

?>
 <script src="{{asset('js/arbol.js')}}"></script>
     <!-- sidebar menu: : style can be found in sidebar.less -->
    <button class='btn btn-danger' data-toggle='modal' data-target='#myModal' >AGREGAR</button>  
 <center> <h1 >PLAN DE CUENTA</h1></center>
<section class="sidebar">
    <!-- Sidebar user panel -->



    <div class="container" >
        <div class="row" >
            <div class="col-md-5" id="nested"  >
  <?php
                foreach ($masters as $master) {
                    ?>
                     <li style="margin: 5px 0px">
                            <span><i class="glyphicon glyphicon-folder-open"></i></span>
                        <a href="#" data-status="<?php echo $master->hijo ?>" 
                           style="margin: 1px 6px; color: black" class="btn btn-warning btn-xs btn-folder">
                           <span style='color:white'  class="<?php
                            echo $master->hijo == 1 ?
                                   'glyphicon glyphicon-minus-sign':
                                    'glyphicon glyphicon-plus-sign' 
                                    ?>"aria-hidden="true" ></span><b>  
                            <?php echo " ".$master->codigo ?>
                            <?php echo " ".$master->nombre ?></b></a>
                      <?php echo Arbol::nested($childrens, $master->id) ?>
                        
                    </li>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
      
    </script>
        <script src="{{asset('js/cuenta.js')}}"></script> 

</section>

@endsection

 