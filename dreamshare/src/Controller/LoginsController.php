<?php
////////////////////
//
// @Author: Brian M.
///////////////////

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Logins Controller
 *
 * @property \App\Model\Table\LoginsTable $Logins
 *
 * @method \App\Model\Entity\Login[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LoginsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        //$logins = $this->paginate($this->Logins);
        //
        //$this->set(compact('logins'));
    }

    /**
     * View method
     *
     * @param string|null $id Login id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $login = $this->Logins->get($id, [
            'contain' => [],
        ]);

        $this->set('login', $login);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

    }

    /**
     * Edit method
     *
     * @param string|null $id Login id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $login = $this->Logins->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $login = $this->Logins->patchEntity($login, $this->request->getData());
            if ($this->Logins->save($login)) {
                $this->Flash->success(__('The login has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The login could not be saved. Please, try again.'));
        }
        $this->set(compact('login'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Login id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $login = $this->Logins->get($id);
        if ($this->Logins->delete($login)) {
            $this->Flash->success(__('The login has been deleted.'));
        } else {
            $this->Flash->error(__('The login could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function loginUser($namex, $surnamex, $temp2, $temp1, $dts){
      try {
        $temp3 = $_SESSION['email'];
        $userid = $_SESSION['userid'];
        $info = "<p>".$temp3."</p>";
        $info .= "<h3>".$userid."</h3>";
        $login_table = TableRegistry::get('logins');
        $login = $login_table->newEntity();
        $tempp = LoginsController::hashData($temp1, $temp2);
        $options = ['cost' => 8,];
        $login->password = password_hash($tempp, PASSWORD_BCRYPT, $options);
        $login->logdate = date("Y-m-d H:i:s");
        $login->name = $namex;
        $login->surname = $surnamex;
        $login->email = $temp2;
        $login->userid = $userid;
        $dts = time();
        $login->comments = "Refn#".$userid.": ".$dts;
        $info .= "<h3>".$login->comments."</h3>";
        if($temp3 == $temp2 ){
          if ($login_table->save($login)) {
              echo $info;
              header("Location: /users/online");
              exit;
          } else {
            echo "Login Error: ".$dts;
          }
        }
      } catch (Exception $ex) {
        echo "<h3> Error: ".$dts."</h3>";
      }
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
}
