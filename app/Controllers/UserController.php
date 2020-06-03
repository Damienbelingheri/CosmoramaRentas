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
                    $goodList[] = "Hola, " . $foundUser->getPseudo() . " (" . $foundUser->getRole() . ")";
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

            //récupère nos données
            $email = trim(strip_tags(filter_input(INPUT_POST, 'email')));
            $emailToConfront = filter_input(INPUT_POST, 'emailToConfront');
            $password = filter_input(INPUT_POST, 'password');
            $passwordToConfront = filter_input(INPUT_POST, 'passwordToConfront');
            $username = strip_tags(filter_input(INPUT_POST, 'username'));
            //$role = strip_tags(filter_input(INPUT_POST, 'role'));
            //$status = strip_tags(filter_input(INPUT_POST, 'status'));



            //     elseif (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",$password)) {
            //        $errorsList['password'] = "la forma de tu contraseña es incorecta ! ";
            //    }

            if ($emailToConfront === $email) {
                $email;
            } else {
                $errorsList["email"] = "emails ne correspondent pas ";
            }

            if ($passwordToConfront === $password) {

                dump($password);
                $password = password_hash($password, PASSWORD_DEFAULT);
            } else {

                $errorsList["password"] = "Mot de passe ne correspondent pas ";
            }
            dump('coucou', $username, $password, $errorsList,$email);
            //instancie notre class
            $user = new AppUser();

            $user->setPassword($password);

            //hydrate l'instance
            $user->setEmail($email);
            $user->setUsername($username);
            //$user->setRole($role);
            //$user->setStatus($status);


            $userValidator = v::attribute('email', v::notEmpty()->email())
                ->attribute('username', v::notEmpty())
                ->attribute('password', v::notEmpty()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'));

            try {
                $userValidator->assert($user);
            } catch (NestedValidationException $ex) {
                $coll = collect($ex->getMessages());
                $messages = $coll->flatten();

                foreach ($coll as $key => $message)
                    $errorList["$key"] = $message;
            }


            dump($errorList);
            if (empty($messages) && empty($errorsList)) {
                //la sauvegarde avec insert()
                
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
        $emailCompared = [];
        $passwordHash = [];

        $foundUser = AppUser::find($id);

        if (!empty($_POST)) {
            //récupère l'email et le mot de passe du formulaire
            $email = filter_input(INPUT_POST, 'email');
            $emailToConfront = filter_input(INPUT_POST, 'emailToConfront');
            $password = filter_input(INPUT_POST, 'password');
            $passwordToConfront = filter_input(INPUT_POST, 'passwordToConfront');
            $role = filter_input(INPUT_POST, 'role');
            $status = intval(filter_input(INPUT_POST, 'status'));


            if ($emailToConfront === $email) {
                $emailCompared = $email;
            } else {
                $_SESSION["email"] = "emails ne correspondent pas ";
            }

            if ($passwordToConfront === $password) {

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $passwordHash;
            } else {

                $_SESSION["password"] = "Mot de passe ne correspondent pas ";
            }


            $user = new AppUser();
            $user->setId($id);
            $user->setEmail($emailCompared);
            $user->setPassword($passwordHash);
           // $user->setRole($role);
           // $user->setStatus($status);

            //si l'insert s'est bien passé... 
            if ($user->update()) {
                //ajoute un message qui s'affichera sur la prochaine page ! 
                //pour l'affichage, voir dans header.tpl.php
                $_SESSION['alert'] = "l'utilisateur a bien été modifié !";
                //on redirige vers la liste des produits
                $this->redirectToRoute("user-list");
            }
        }

        $this->show("user/update", ["user" => $foundUser]);
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
            $_SESSION['alert'] = "Votre utilisateur a bien été supprimée !";
            //on redirige vers la liste des categories


            $this->redirectToRoute("user-list");
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