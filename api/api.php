<?php
include 'myguests.php';
class API
{
    private $requestMethod;
    private $guestId;
    private $myguest;

    public function __construct($requestMethod, $guestId)
    {
        $this->requestMethod = $requestMethod;
        $this->guestId = $guestId;
        $this->myguest = new MyGuests();
    }

    public function processRequest($mypost_arr=FALSE)
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->guestId) {
                    $response = $this->getUser($this->guestId);
                } else {
                    $response = $this->getAllUsers();
                };
                break;
            case 'POST':
				if(!empty($mypost_arr))
				{
					$response = $this->createUserFromRequest($mypost_arr);
				}
				else
				{
					$response = $this->unprocessableEntityResponse();
				}
                break;
            case 'PUT':
				if(!empty($mypost_arr))
				{
					$response = $this->updateUserFromRequest($this->guestId,$mypost_arr);
				}
				else
				{
					$response = $this->unprocessableEntityResponse();
				}
                break;
            case 'DELETE':
                $response = $this->deleteUser($this->guestId);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAllUsers()
    {
        $result = $this->myguest->read();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getUser($id)
    {
        $result = $this->myguest->read($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createUserFromRequest(array $post_arr)
    {
        $input = $post_arr;//(array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validatePerson($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->myguest->insert($input['firstname'],$input['lastname'],$input['email']);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = TRUE;
        return $response;
    }

    private function updateUserFromRequest($id,array $post_arr)
    {
        $result = $this->myguest->read($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $input = $post_arr;//(array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validatePerson($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->myguest->update($id, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = TRUE;
        return $response;
    }

    private function deleteUser($id)
    {
        $result = $this->myguest->read($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $this->myguest->remove($id);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = TRUE;
        return $response;
    }

    private function validatePerson($input)
    {
        if (! isset($input['firstname'])) {
            return false;
        }
        if (! isset($input['lastname'])) {
            return false;
        }
        return true;
    }

    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}

#for getting all record
/*$api_obj=new API('GET',NULL);
$res=$api_obj->processRequest();
echo "<pre>";
print_r($res);
echo "</pre>";*/

#for getting single record
/*$api_obj=new API('GET',2);
$res=$api_obj->processRequest();
echo "<pre>";
print_r($res);
echo "</pre>";*/

#for inserting record
/*$api_obj=new API('POST',NULL);
$res=$api_obj->processRequest($_POST);
echo "<pre>";
print_r($res);
echo "</pre>";*/

#for deleting record
/*$api_obj=new API('DELETE',13);
$res=$api_obj->processRequest();
echo "<pre>";
print_r($res);
echo "</pre>";*/

#for update record
/*$api_obj=new API('PUT',11);
$res=$api_obj->processRequest($_POST);
echo "<pre>";
print_r($res);
echo "</pre>";*/
?>