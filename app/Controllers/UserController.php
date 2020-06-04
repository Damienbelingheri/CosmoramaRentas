<?php

namespace App\Controllers;

use App\Models\AppUser;
use App\Models\Category;
use App\Models\Product;
use IntlChar;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class UserController extends CoreController
{

    /**
     * Méthode s'occupant de la page d'accueil du backoffice
     *
     * @return void
     */
    public function adminHome()
    {

        $this->show('back/main/home', [
            "mainCategories" => Category::findAll(),
            "mainProducts" => Product::findAll()
        ]);
    }

    /**
     * method for login
     *
     * @return void
     */
    public function login()
    {

      
        //tableau d'éventuels messages d'erreur de validation
        $errorsList = [];
        $goodList = [];
        //si le form est soumis...     
        if (!empty($_POST)) {
            $this->validateCsrfToken();
            //récupère l'email et le mot de passe du formulaire
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');

        

            //aller chercher dans la bdd si j'ai bien un user ayant cet email
            $foundUser = AppUser::findByEmail($email);
            //si on trouve le user 
            if ($foundUser) {
                //on vérifie que son mdp est bon
                if (password_verify($password, $foundUser->getPassword())) {
                    //si c'est le bon... 
                    //connecte le user 
                    $goodList[] = "Hola, " . $foundUser->getUsername(). " (" . $foundUser->getRole() . ")";
                    $_SESSION['userConnected'] = ["userId" => $foundUser->getId(), "userObject" => $foundUser];
                    // redirect to main/select

                    $this->redirectToRoute("admin-home");
                } else {
                    $errorsList['password'] = "Password incorecto !";
                }
            } else {
                $errorsList['email'] = "email incorecto !";
            }

            //valide l'email 
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorsList['email'] = " Problema con tu email !";
            }
        }

        dump($errorsList,$goodList);
        $this->show('back/user/login', ["errorsList" => $errorsList, "goodList" => $goodList, 'temoin' => true]);
    }



    /**
     * method for logout
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['userConnected']);
        $this->redirectToRoute("main-home");
    }



    /**
     * method to list all user
     * only for admin
     *
     *
     * @return void
     */
    public function list()
    {
        $listUsers = AppUser::findAll();
        $this->show('back/user/list', ["users" => $listUsers]);
    }


    /**
     * method for add user
     * Only admin
     *
     * @return void
     */
    public function add()
    {
        //contient les messages d'erreur de validation
        $errorsList = [];
        $succesList = [];

        //si c'est soumis, on traite le form...
        if (!empty($_POST)) {

            $this->validateCsrfToken();
            
            $token = filter_input(INPUT_POST, 'csrf_token');
            //dd($token);
            //récupère nos données
            $email = trim(strip_tags(filter_input(INPUT_POST, 'email')));
            $emailToConfront = filter_input(INPUT_POST, 'emailToConfront');
            $password = filter_input(INPUT_POST, 'password');
            $passwordToConfront = filter_input(INPUT_POST, 'passwordToConfront');
            $username = strip_tags(filter_input(INPUT_POST, 'username'));
            $role = strip_tags(filter_input(INPUT_POST, 'role'));
            //$status = strip_tags(filter_input(INPUT_POST, 'status'));



            //     elseif (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",$password)) {
            //        $errorsList['password'] = "la forma de tu contraseña es incorecta ! ";
            //    }

            if ($emailToConfront !== $email) {
                $errorsList["emailCompared"] = "emails must be equals";
            }

            if ($passwordToConfront === $password ) {
                $passwordCompared = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $errorsList["passwordCompared"] = "password must be equals ";
            }

            $user = new AppUser();

            if (!v::regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/')->notEmpty()->validate($password)) { 
            $errorsList['password']='Password must contain minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character'; }// true

                //hydrate l'instance
                $user->setEmail($email);
                $user->setUsername($username);
                $user->setPassword($passwordCompared);
                $user->setRole($role);
                //$user->setStatus($status);

                $userValidator = v::attribute('email', v::notEmpty()->email())
                    ->attribute('username', v::notEmpty())
                    ->attribute('role', v::notEmpty()->regex('/^(admin|catalog-manager)$/'));

                try {
                    $userValidator->assert($user);
                } catch (NestedValidationException $ex) {
                    $coll = collect($ex->getMessages());
                    $messages = $coll->flatten();

                    foreach ($coll as $key => $message)
                        $errorsList["$key"] = $message;
                }

            //    dd($errorsList);
                if (empty($errorsList)) {
                    if ($user->insert()) {
                        $succesList['insertOk'] = 'account created';
                        $this->redirectToRoute("admin-home");
                    }
                }
        }

        $this->show('back/user/add', [
            'errorsList' => $errorsList,
            'succesList' => $succesList,
        ]);
    }

    /**
     * method to update one user
     * only admin
     * @param int $id
     * @return void
     */
    public function update($id)
    {


        $errorsList = [];
        $succesList = [];
        ;
       if (!empty($_POST)) {

            $this->validateCsrfToken();
            
            $token = filter_input(INPUT_POST, 'csrf_token');
            dd($token);
            //récupère nos données
            $email = trim(strip_tags(filter_input(INPUT_POST, 'email')));
            $emailToConfront = filter_input(INPUT_POST, 'emailToConfront');
            $password = filter_input(INPUT_POST, 'password');
            $passwordToConfront = filter_input(INPUT_POST, 'passwordToConfront');
            $username = strip_tags(filter_input(INPUT_POST, 'username'));
            $role = strip_tags(filter_input(INPUT_POST, 'role'));
            //$status = strip_tags(filter_input(INPUT_POST, 'status'));



            //     elseif (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",$password)) {
            //        $errorsList['password'] = "la forma de tu contraseña es incorecta ! ";
            //    }

            if ($emailToConfront !== $email) {
                $errorsList["emailCompared"] = "emails must be equals";
            }

            if ($passwordToConfront === $password ) {
                $passwordCompared = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $errorsList["passwordCompared"] = "password must be equals ";
            }

            $user = new AppUser();

            if (!v::regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/')->notEmpty()->validate($password)) { 
            $errorsList['password']='Password must contain minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character'; }// true

                //hydrate l'instance
                $user->setEmail($email);
                $user->setUsername($username);
                $user->setPassword($passwordCompared);
                $user->setRole($role);
                //$user->setStatus($status);

                $userValidator = v::attribute('email', v::notEmpty()->email())
                    ->attribute('username', v::notEmpty())
                    ->attribute('role', v::notEmpty()->regex('/^(admin|catalog-manager)$/'));

                try {
                    $userValidator->assert($user);
                } catch (NestedValidationException $ex) {
                    $coll = collect($ex->getMessages());
                    $messages = $coll->flatten();

                    foreach ($coll as $key => $message)
                        $errorsList["$key"] = $message;
                }

            //    dd($errorsList);
                if (empty($errorsList)) {
                    if ($user->insert()) {
                        $succesList['insertOk'] = 'account created';
                        $this->redirectToRoute("admin-home");
                    }
                }
        }


        $this->show("back/user/update", 
        [
            "user" => AppUser::find($id),
            'errorsList' => $errorsList,
            'succesList' => $succesList
            ]
        );
    }



    /**
     * method to delete one user
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {


        $user = new AppUser();
        $user->setId($id);


        if ($user->delete($id)) {
            //ajoute un message qui s'affichera sur la prochaine page ! 
            //pour l'affichage, voir dans header.tpl.php
            $_SESSION['alert'] = "el usuario ha sido eliminado";
            //on redirige vers la liste des categories
            $this->redirectToRoute("admin-user-list");
        }
    }
}





/* Essai avec comparaison du mail et du password   
public function add()
{ 


     //contient les messages d'erreur de validation
     $errorsList = [];


    //est-ce que le form est soumis ?? 
    //si oui, on le traite
    if (!empty($_POST)){
        //récupère l'email et le mot de passe du formulaire
        $email = filter_input(INPUT_POST, 'email');
        $emailToConfront = filter_input(INPUT_POST, 'emailToConfront');
        $password = filter_input(INPUT_POST, 'password');
        $passwordToConfront = filter_input(INPUT_POST, 'passwordToConfront');
        $firstname = filter_input(INPUT_POST, 'firstname');
        $lastname = filter_input(INPUT_POST, 'lastname' );
        $role = filter_input(INPUT_POST, 'role');
        $status = filter_input(INPUT_POST, 'status');



        //aller chercher dans la bdd si j'ai bien un user ayant cet email
        $user = AppUser::findByEmail($email);
        //dump($foundUser);
        

       if($emailToConfront === $email){
       
           return $emailCompared = $email  ;
           

      } else {
       $_errorList["email"] = "emails ne correspondent pas ";

      }
      
       if($passwordToConfront === $password){

         $passwordHash = password_hash($password, PASSWORD_DEFAULT) ;
       

       $user->setEmail($emailCompared);
       $user->setPassword($passwordHash);
       $user->setFirstname($firstname);
       $user->setLastname($lastname);
       $user->setRole($role);
       $user->setStatus($status);

       } else {

        $errorsList["password"] = "Mot de passe ne correspondent pas ";
       }
   

        //si l'insert s'est bien passé... 
        if ($user->insert()){
            //ajoute un message qui s'affichera sur la prochaine page ! 
            //pour l'affichage, voir dans header.tpl.php
            $_SESSION['alert'] = "l'utilisateur a bien été ajouté !";
            //on redirige vers la liste des produits
            $this->redirectToRoute("user-list");
            session_unset($_SESSION["password"]);
        }
    }
   

    $this->show('user/add');
}


 */
