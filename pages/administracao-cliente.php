
<div class="container text-center ">
  <h4 class="subtitle">Administração de clientes</h4>
</div>

<div class="container-fluid bg-3 text-center register">    
  <div class="row" >
    <form class="form-horizontal" name="objetoForm" 
      ng-submit="objetoForm.$valid && salvar(objeto)" novalidate>
      
      <input type="hidden" name="id" ng-value="objeto.id">

      <div class="form-group">
        <label class="col-sm-3 control-label">Nome </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="nome" placeholder="Nome" 
            ng-model="objeto.nome" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Telefone/Telemóvel</label>
        <div class="col-sm-6">
            <input type="tel" class="form-control" name="telefone" placeholder="Telefone" ng-model="objeto.telefone" required>
            <p class="help-block" ng-show="objetoForm.telefone.$error.required && objetoForm.telefone.$dirty">Telefone/telemóvel é obrigatório</p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Email</label>
        <div class="col-sm-6">
          <input type="email" class="form-control" name='email' id="email" placeholder="Email" ng-model="objeto.email" required>
          <p class="help-block" ng-show="objetoForm.email.$error.required && objetoForm.email.$dirty">Email é obrigatório</p>
          <p class="help-block" ng-show="objetoForm.email.$error.email && objetoForm.email.$dirty">Email é inválido</p>
          <!-- <pre>{{objetoForm.email.$error}}</pre> -->
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Password</label>
        <div class="col-sm-6">
           <input type="password" class="form-control" name="password" placeholder="Password"  ng-model="objeto.password" required>
           <p class="help-block" ng-show="objetoForm.password.$error.required && objetoForm.email.$dirty">Email é obrigatório</p>
           
        </div>
      </div>

      <button type="reset" class="btn btn-warning"  aria-label="Left Align">Limpar
        <span class=" glyphicon glyphicon-refresh" aria-hidden="true"></span> 
      </button>
      <button type="submit" class="btn btn-success"  aria-label="Left Align" ng-disabled="objetoForm.$invalid">Salvar
        <span class=" glyphicon glyphicon-floppy-save" aria-hidden="true"></span> 
      </button>
      
      <br /><br /> 
      
      <div class="alert alert-success col-md-offset-4 col-sm-4 " role="alert" ng-show="sucesso">
        {{mensagem}}
      </div>
      <div class="alert alert-danger  col-md-offset-4 col-sm-4" role="alert" ng-show="erro">
        {{mensagem}}
      </div>
    </form>
  </div>
</div><br>

<div class="container">
  # Clientes cadastrados: {{objetos.length}}
</div>
<div class="container">
    <table class="table table-condensed">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Telefone</th>
          <th>Email</th>
          <th>Password</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="objeto in objetos | orderBy:'nome':false">
          <td>{{objeto.id}}</td>
          <td>{{objeto.nome}}</td>
          <td>{{objeto.telefone}}</td>
          <td>{{objeto.email}}</td>
          <td>{{objeto.password}}</td>
          <td><button class="btn btn-xs btn-danger glyphicon glyphicon-trash" aria-hidden="true"                
              ng-click="excluir(objeto)"></button>
            <button class="btn btn-xs btn-danger glyphicon glyphicon-pencil" aria-hidden="true"                
              ng-click="escolher(objeto)"></button>
          </td>
        </tr>
      </tbody>
    </table>
</div>
