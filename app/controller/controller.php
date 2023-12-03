<?php
include_once("./app/model/model.php");
include_once("./app/view/view.php");

class Controller
{

  public function receberLogin()
  {

    $con = BancoDados::conexao();
    //pega dados digitados no input de login
    if (isset($_POST['usuario']) && isset($_POST['senha'])) {
      $email = mysqli_real_escape_string($con, $_POST['usuario']);
      $senha = mysqli_real_escape_string($con, $_POST['senha']);

      //enviar para model
      $model = new Model;
      $model = $model->validacaoLogin($email, $senha);


      //enviar pra view
      $view = new View;
      $view = $view->login($model);
    }
  }

  public function controllerCadastro()
  {


    //validar se todos os campos estão preenchidos
    if (!empty($_POST['nome']) && !empty($_POST['email'])  && !empty($_POST['turma'])  && !empty($_POST['serie'])  && !empty($_POST['anoLet'])  && !empty($_POST['dataNasc'])  && !empty($_POST['senha'])  && !empty($_POST['confirSenha'])) {
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $turma = $_POST['turma'];
      $serie = $_POST['serie'];
      $anoLet = $_POST['anoLet'];
      $dataNasc = $_POST['dataNasc'];
      $senha = md5($_POST['senha']);
      $confirSenha = md5($_POST['confirSenha']);



      $model = new Model;
      $model = $model->cadastrar(
        $nome,
        $email,
        $turma,
        $serie,
        $anoLet,
        $dataNasc,
        $senha,
        $confirSenha
      );


      $view = new view;
      $view = $view->viewCadastro($model);
    } else {
      $view = new view;
      $view = $view->viewCadastro("inexistentes");
    }
  }
}