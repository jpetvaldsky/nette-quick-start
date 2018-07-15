<?php
// source: latte/backend/login.latte

use Latte\Runtime as LR;

class Template483ee88923 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		$this->parentName = '@layout-simple.latte';
		
	}


	function blockContent($_args)
	{
?>  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
              <form method="post">
              <h1>Přihlášení</h1>
              <p class="text-muted">Zadejte prosím své přihlašovací údaje</p>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user"></i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="Uživatelské jméno">
              </div>
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-lock"></i>
                  </span>
                </div>
                <input type="password" class="form-control" placeholder="Heslo">
              </div>
              <div class="row">
                <div class="col-6">
                  <button type="submit" class="btn btn-primary px-4">Přihlásit se</button>
                </div>
                <div class="col-6 text-right">
                  <a href="/backend/heslo" class="btn btn-link px-0">Zapoměli jste heslo?</a>
                </div>
              </div>
              </form>
            </div>
          </div>         
        </div>
      </div>
    </div>
  </div><!-- /.container -->
  
<?php
	}

}
