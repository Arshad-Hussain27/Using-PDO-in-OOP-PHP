<?php

include "Classes/Database.php";

class User extends Database
{
    public $table_name = "reg_tab";
    public $id;
    public $name;
    public $fname;
    public $cnic;
    public $phone;
    public $email;
    public $password;
    public $gender;
    public $image;
    public $city;
    public $address;


    // ____________registeration____________________
    public function register(){   
        $query = "INSERT INTO " . $this->table_name . " (name, fname, cnic, phone, email, password, gender, image, city, address)
                  VALUES (:name, :fname, :cnic, :phone, :email, :password, :gender, :image, :city, :address)";

        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':fname', $this->fname);
        $stmt->bindParam(':cnic', $this->cnic);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':address', $this->address);


        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }


    public function user_Exists() {
        $query = "SELECT email FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['email'=>$this->email]);
        if($stmt->fetch(PDO::FETCH_ASSOC)){
           return true;
        }else{
          return false;
        }


    }

//   _____________________Login______________________

public function Login() {
    $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':email', $this->email);

    if ($stmt->execute()) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($this->password, $row['password'])) {
            $this->id = $row['id'];
            $this->name = $row['name'];
 
            return true;
        }
    }

    return false;
}


}
?>
