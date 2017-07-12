<div class="container text-center ">
  <h4 class="subtitle">Administração de produtos</h4>
</div>

<div class="container-fluid bg-3 text-center register">    
  <div class="row" >
    <form class="form-horizontal" name="produtoForm" 
      ng-submit="produtoForm.$valid  && salvar(objeto)" novalidate>
      
      <input type="hidden" name="id" ng-value="objeto.id">

      <div class="form-group">
        <label class="col-sm-3 control-label">Nome </label>
        <div class="col-sm-6">
           <input type="text" class="form-control" id="nome" placeholder="Nome" 
            ng-model="objeto.nome" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Descrição</label>
        <div class="col-sm-6">
           <input type="text" class="form-control" id="descricao" placeholder="Descrição" 
            ng-model="objeto.descricao" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Valor</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="valor" placeholder="Valor" 
            ng-model="objeto.valor" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Quantidade</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="quantidade" placeholder="Quantidade" 
            ng-model="objeto.quantidade" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Unidade </label>
        <div class="col-sm-6">
           <input type="text" class="form-control" id="unidade" placeholder="Unidade" 
            ng-model="objeto.unidade" required>
        </div>
      </div>
      
      <button type="reset" class="btn btn-warning"  aria-label="Left Align">Limpar
        <span class=" glyphicon glyphicon-refresh" aria-hidden="true"></span> 
      </button>
      <button type="submit" class="btn btn-success"  aria-label="Left Align">Salvar
        <span class=" glyphicon glyphicon-floppy-save" aria-hidden="true"></span> 
      </button>
      
      <br /><br /> 
      
      <div class="alert alert-success col-md-offset-4 col-sm-4 " role="alert" ng-show="controller.sucesso">
        {{mensagem}}
      </div>
      <div class="alert alert-danger  col-md-offset-4 col-sm-4" role="alert" ng-show="controller.erro">
        {{mensagem}}
      </div>
    </form>
  </div>
</div><br>

  <div class="container">
    # Clientes cadastrados: {{objeto.length}}
  </div>
  <div class="container">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Quantidade</th>
            <th>Unidade</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="objeto in objetos | orderBy:'nome':false">
            <td>{{objeto.id}}</td>
            <td></td>
            <td>{{objeto.nome}}</td>
            <td>{{objeto.descricao}}</td>
            <td>{{objeto.quantidade}}</td>
            <td>{{(objeto.valor | number:2) + " €"}}</td>
            <td>{{objeto.unidade}}</td>
            <td><button class="btn btn-xs btn-danger glyphicon glyphicon-trash" aria-hidden="true"                
               ng-click="excluir(objeto)"></button>
              <button class="btn btn-xs btn-danger glyphicon glyphicon-pencil" aria-hidden="true"                
               ng-click="escolher(objeto)"></button>
            </td>
          </tr>
        </tbody>
      </table>
  </div>
