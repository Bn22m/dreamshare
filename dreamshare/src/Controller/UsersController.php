<?php
////////////////////
//
// @Author: Brian M.
///////////////////

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
      /*//
      //$users = $this->paginate($this->Users);
      //
      //$this->set(compact('users'));
      //*/
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $temp1 = $user->password;
            $temp2 = $user->email;
            $temp3 = $user->name;
            $user->create = date("Y-m-d H:i:s");
            $temp4 = $this->hashData($temp1, $temp2);
            $options = ['cost' => 8,];
            $user->password = password_hash($temp4, PASSWORD_BCRYPT, $options);
            $dts = time();
            $user->image = $temp3.$dts.".jpg";
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                $this->usrImage($user->image);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
      /*//
      //  $user = $this->Users->get($id, [
      //      'contain' => [],
      //  ]);
      //  if ($this->request->is(['patch', 'post', 'put'])) {
      //      $user = $this->Users->patchEntity($user, $this->request->getData());
      //      if ($this->Users->save($user)) {
      //          $this->Flash->success(__('The user has been saved.'));
      //
      //          return $this->redirect(['action' => 'index']);
      //      }
      //      $this->Flash->error(__('The user could not be saved. Please, try again.'));
      //  }
      //  $this->set(compact('user'));
      //*/
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        /*//
        //$this->request->allowMethod(['post', 'delete']);
        //$user = $this->Users->get($id);
        //if ($this->Users->delete($user)) {
        //    $this->Flash->success(__('The user has been deleted.'));
        //} else {
        //    $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        //}
        //
        //return $this->redirect(['action' => 'index']);
        //*/
    }

    public function all()
    {
      $users = $this->paginate($this->Users);

      $this->set(compact('users'));
    }

    public function login()
    {
      try {
      $user = $this->Users->newEntity();
      if ($this->request->is('post')) {
          $user = $this->Users->patchEntity($user, $this->request->getData());
          $temp1 = $user->password;
          $temp2 = $user->email;
          $logdate = date("Y-m-d H:i:s");
          $passwordy = $this->hashData($temp1, $temp2);
          $dts = time();
          $user_table = TableRegistry::get('users')->find();
          $userx = $user_table->where(['email'=>$temp2])->first();
          $passwordx = $userx->password;
          if(password_verify($passwordy, $passwordx)){
            $useridx = $userx->id;
            $namex = $userx->name;
            $surnamex = $userx->surname;
            $emailx = $userx->email;
            $imgx = $userx->image;
            $info1 = "ok: ".$dts;
            session_start();
            $_SESSION["name"] = $namex;
            $_SESSION["email"] = $temp2;
            $_SESSION["refn"] = $dts;
            $_SESSION["userid"] = $useridx;
            $_SESSION["image"] = $imgx;
            $info1 .= ", Session id: ".session_id();
            LoginsController::loginUser($namex, $surnamex, $emailx, $passwordy, $dts);
            $this->Flash->success(__($info1));
          } else {
            $info2 = "System Error: ".$dts;
            $this->Flash->error(__($info2));
          }
        }
        $this->set(compact('user'));
        }
        catch (Exception $e) {
          echo "Sytem error.";
        }
    }

    public function online()
    {

    }

    private function hashData($x, $y){
      $temp = "temp1@";
      $temp .= $x;
      $temp .= $y;
      $temp .= $y[1];
      $temp .= $x[1];
      $temp2 = hash('sha256', $temp);
      return $temp2;
    }

    private function usrImage($imgx){
      $nwidth = 100;
      $nheight = 100;
      $thumb = imagecreatetruecolor($nwidth, $nheight);
      $jpim = "webroot/img/part1.jpg";
      $fname = "webroot/img/img2/".$imgx;
      $source = imagecreatefromjpeg($jpim);
      list($width, $height, $type, $attr) = getimagesize($jpim);
      imagecopyresized($thumb, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
      header('Content-Type: image/jpeg');
      imagejpeg($thumb, $fname, 75);
      imagedestroy($thumb);
    }
}
