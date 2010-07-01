<?php

/**
 * users actions.
 *
 * @package    symfony
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usersActions extends sfActions {
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeViewUser(sfWebRequest $request) {
        $this->user=Doctrine::getTable('Usuario')->find($request->getParameter('login'));
    }

    public function executeDirectory(sfWebRequest $request) {

    }

    public function executeDoSearch(sfWebRequest $request) {
        $this->usuarios=Doctrine::getTable('Usuario')
                    ->createQuery('u')
                    ->addWhere('LOWER(u.ca_nombre) LIKE ?', '%'.strtolower($request->getParameter('criterio')).'%')
					->addWhere('u.ca_activo = ?', true)
					->distinct()
                    ->execute();
					

    }
    /**
	* Muestra un formulario donde un usuario puede iniciar sesion
	*
	* @param sfRequest $request A request object
	*/
	public function executeLogin($request)
	{
        //header("Location: /users/login");
        //exit();
		//echo "login".session_id();
		//$response = sfContext::getInstance()->getResponse();
		//$response->addStylesheet("login");

		if($this->getUser()->isAuthenticated()){
			$this->redirect("homepage/index");
		}

		$this->form = new LoginForm();
		if ($request->isMethod('post')){
			$this->form->bind(
				array(
						'username' => $request->getParameter('username'),
						'passwd' => $request->getParameter('passwd')
					)
				);
			if( $this->form->isValid() ){
				//Se valido correctamente
				$this->redirect("homepage/index");
				//echo "OK";
			}
		}

		$this->setLayout("login");
	}
	
	public function executeLogout($request)
	{
		$this->getUser()->signOut();
		$this->redirect("users/login");
	}
    public function executeTraerImagen($request)
    {
        $username=$request->getParameter('username');
        $user=Doctrine::getTable('Usuario')->find($username);

        $this->imagen=$user->getImagen();
    }

}

	


