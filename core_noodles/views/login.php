<style>
.log-in-form {
    border: 1px solid #cacaca;
    padding: 1rem;
    border-radius: 0;
}
</style>

<div class="row">
    <div>
        <div class="signup-panel medium-5 columns align-self-middle small-centered">
            <div class="text-center">
                <br>
                <img src="/theme/img/logo.png"/>
                <br>
                <br>
            </div>

            <form id="login" class="log-in-form" action="/login/login_form/" method="post" enctype="multipart/form-data">
                <h4 class="text-center"><?php echo $_SESSION['configuracion'][1]["valor"];?></h4>
                <label>Nombre de usuario
                <input type="text" placeholder="usuario" name="usuario">
              </label>
              <label>Contraseña
                <input type="password" placeholder="Password"  name="password">
              </label>
              <p><input type="submit" class="button expanded" value="Entrar"></input></p>
            </form>
        </div>
    </div>

    <div class="reveal" id="error_login" data-reveal>
      <h1>¡Algo raro pasó!</h1>
      <p class="lead">El usuario o contraseña están mal</p>
      <p>Verifica el usuario y la contraseña, recuerda mayúsculas y minúsculas. En otro caso comunicate con el administrador</p>
      <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div id="error_login2" class="reveal" data-reveal aria-labelledby="firstModalTitle" data-options="closeOnBackgroundClick:false" aria-hidden="true" role="dialog">
        <h2 id="firstModalTitle">¡Usuario o contraseña incorrecta!</h2>
        <p>Verifica e intenta de nuevo</p>
        <a class="close-reveal" aria-label="Close">&#215;</a>
    </div>
</div>
