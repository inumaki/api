<?php
include 'database.php';
class MyGuests
{
	private $conn;
	public function __construct()
	{
		new Database();
		$this->conn=Database::getConnect();
	}
	public function insert($first_name,$last_name,$email)
	{
		$status=FALSE;
		if((!empty($first_name))&&(!empty($last_name))&&(!empty($email)))
		{
			$sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES ('$first_name', '$last_name', '$email')";
			$this->conn->query($sql);
			$status=TRUE;
		}
		else
		{
			echo "No data to insert.";
			$status=FALSE;
		}
		return $status;
	}
	public function read($guest_id=FALSE)
	{
		$myresult=array();
		if(!empty($guest_id))
		{
			$sql = "SELECT id, firstname, lastname FROM MyGuests WHERE id=$guest_id";
			$result = $this->conn->query($sql);
			$myresult=$result->fetch_assoc();
		}
		else
		{
			$sql = "SELECT id, firstname, lastname FROM MyGuests";
			$result = $this->conn->query($sql);
			$myresult=$result->fetch_all(MYSQLI_ASSOC);
		}
		return $myresult;		
	}
	public function update($guest_id,$update_arr) 
	{
		$status=FALSE;
		if((!empty($guest_id))&&(!empty($update_arr)))
		{
			foreach($update_arr as $key=>$value)
			{
				$sql = "UPDATE MyGuests SET $key='$value' WHERE id='$guest_id'";
				$this->conn->query($sql);
				$status=TRUE;
			}
		}		
		return $status;
	}
	public function remove($guest_id=FALSE)
	{
		$status=FALSE;
		if(!empty($guest_id))
		{
			$sql = "DELETE FROM MyGuests WHERE id=".$guest_id;
			$this->conn->query($sql);
			$status=TRUE;
		}
		else
		{
			$sql = "DELETE FROM MyGuests";
			$this->conn->query($sql);
			$status=TRUE;
		}
		return $status;
	}
}
#creating object of the orm entity class
#$obj=new MyGuests();

#CREATE
/*$status=$obj->insert("Test","Kumar","tesla@tes.com");
echo "<pre>";
print_r($status);
echo "</pre>";*/

#READ
//read single record
/*$res_arr=$obj->read(2);
echo "<pre>";
print_r($res_arr);
echo "</pre>";*/
//read all records
/*$res_arr=$obj->read();
echo "<pre>";
print_r($res_arr);
echo "</pre>";*/

#UPDATE
//update single column
/*$status=$obj->update(1,["lastname"=>"Kumar"]);
echo "<pre>";
print_r($status);
echo "</pre>";*/
//update multiple column
/*$status=$obj->update(1,["email"=>"pranesh_mittal@gmail.com","lastname"=>"Mittal"]);
echo "<pre>";
print_r($status);
echo "</pre>";*/

#DELETE
//delete single record
/*$status=$obj->remove(1);
echo "<pre>";
print_r($status);
echo "</pre>";*/
//delete all record
/*$status=$obj->remove();
echo "<pre>";
print_r($status);
echo "</pre>";*/
?>