<div id="loginGuest">
  <div class="row">
    <div class="col-md-4 offset-md-4 square-container">
      <form id="loginForm" class="col-md-12">
        <div class="row">
          <div class="form-group full-width">
            <label for="password">Ingresa tu contraseña</label>
            <p class="error-message">Contraseña incorrecta</p>
            <input type="password" class="form-control" id="password-input" name="password" placeholder="Contraseña">
          </div>
          <input type="text" name="link" value="<?php echo $link ?>" class="hide" id="link-guest">
          <button id="loginButton" class="btn btn-secondary full-width" type="button" name="button">Entrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
