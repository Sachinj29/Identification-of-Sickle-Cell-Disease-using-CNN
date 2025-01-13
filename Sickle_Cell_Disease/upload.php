<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$filename = $_FILES["fileToUpload"]["name"];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";

        // Call Python script with image file path as argument
        $output = shell_exec("C:/Users/prath/anaconda3/envs/Project/python.exe classify_image.py uploads/" . $filename . " 2>&1");

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'mydb');
        if ($conn->connect_error) {
            echo "$conn->connect_error";
            die("Connection Failed : " . $conn->connect_error);
        } else {
            // Retrieve other form data
            $name = $_POST['patientName'];
            $birthdate = $_POST['birthdate'];
            $age = $_POST['age'];
            $date = $_POST['appointmentDate'];
            $number = $_POST['contactNumber'];
            $image = $target_dir . $filename;

            // Prepare and execute SQL statement
            $stmt = $conn->prepare("INSERT INTO patient (Name, Date, Age, Birth_Date, Contact_No, Image, Status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssisiss", $name, $date, $age, $birthdate, $number, $image, $output);
            $execval = $stmt->execute();

            // Close statement and connection
            $stmt->close();
            $conn->close();

            echo "<script>alert('Patient Data Successfully Entered')</script>";
            echo "<script>window.location.href='customer_details.php?name=$name'</script>";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


// $target_dir = "uploads/";
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $filename = $_FILES["fileToUpload"]["name"];
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// // Database connection

// // Check if image file is a actual image or fake image
// if (isset($_POST["submit"])) {
//     $check =  getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if ($check !== false) {
//         // Call Python script with image file path as argument asynchronously
//         $output = shell_exec("C:/Users/prath/anaconda3/envs/Project/python.exe classify_image.py uploads/" . $filename . " 2>&1");
//         // Display the prediction output
//         // Check if $output is not NULL and contains the classification result
//         if ($output !== null && !empty($output)) {
//             // Remove any leading/trailing whitespace or newline characters
//             $output = trim($output);
//             // Proceed with database operation only if $output is not NULL
//             // and contains a valid classification result
//             if ($output !== null) {
//                 // Move database operation code inside this block
//                 // Check file existence, size, allowed formats, etc.
//                 // Your existing file upload and validation code goes here
//                 // Check if file already exists
//                 if (file_exists($target_file)) {
//                   echo "Sorry, file already exists.";
//                   $uploadOk = 0;
//                 }

//                 // Check file size
//                 if ($_FILES["fileToUpload"]["size"] > 500000) {
//                   echo "Sorry, your file is too large.";
//                   $uploadOk = 0;
//                 }

//                 // Allow certain file formats
//                 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//                 && $imageFileType != "gif" ) {
//                   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//                   $uploadOk = 0;
//                 }

//                 // Check if $uploadOk is set to 0 by an error
//                 if ($uploadOk == 0) {
//                   echo "Sorry, your file was not uploaded.";
//                 // if everything is ok, try to upload file
//                 } else {
//                   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//                     echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
//                   } else {
//                     echo "Sorry, there was an error uploading your file.";
//                   }
//                 }

//                 $name = $_POST['patientName'];
//                 $birthdate = $_POST['birthdate'];
//                 $age = $_POST['age'];
//                 $date = $_POST['appointmentDate'];
//                 $number = $_POST['contactNumber'];
//                 $image =$target_dir.$filename;
//                 // Database connection and data insertion
//                 $conn = new mysqli('localhost', 'root', '', 'mydb');
//                 if ($conn->connect_error) {
//                     echo "$conn->connect_error";
//                     die("Connection Failed : " . $conn->connect_error);
//                 } else {
//                     // Prepare and execute the database query
//                     $stmt = $conn->prepare("INSERT INTO patient (Name, Date, Age, Birth_Date, Contact_No, Image, Status) VALUES (?, ?, ?, ?, ?, ?, ?)");
//                     $stmt->bind_param("ssisiss", $name, $date, $age, $date, $number, $image, $output);
//                     $execval = $stmt->execute();

//                     // Check if query execution was successful
//                     if ($execval) {
//                         echo "<script>alert('Patient Data Successfully Entered')</script>";
//                         // Redirect to the desired page after successful data entry
//                         echo "<script>window.location.href='customer_details.php?name=$name'</script>";
//                     } else {
//                         echo "Error: " . $stmt->error;
//                     }

//                     // Close statement and database connection
//                     $stmt->close();
//                     $conn->close();
//                 }
//             } else {
//                 echo "Invalid classification result. Please try again.";
//             }
//         } else {
//             echo "Failed to classify the image. Please try again.";
//         }
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }
// $target_dir = "uploads/";
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $filename=$_FILES["fileToUpload"]["name"];
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


	

// 	// Database connection
	

// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check =  getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   if($check !== false) {
//     //echo "File is an image - " . $check["mime"] . ".";
//     //$uploadOk = 1;
//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if($check !== false) {
//         // Call Python script with image file path as argument
//         $output = shell_exec("python classify_image.py uploads/".$filename);
//         // Display the prediction output    }
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }
// }

// // Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// // Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//   echo "Sorry, your file is too large.";
//   $uploadOk = 0;
// }

// // Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }

// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//   echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//     echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
//   } else {
//     echo "Sorry, there was an error uploading your file.";
//   }
// }

// $name = $_POST['patientName'];
// $birthdate = $_POST['birthdate'];
// $age = $_POST['age'];
// $date = $_POST['appointmentDate'];
// $number = $_POST['contactNumber'];
// $image =$target_dir.$filename;

// $conn = new mysqli('localhost','root','','mydb');
// 	if($conn->connect_error){
// 		echo "$conn->connect_error";
// 		die("Connection Failed : ". $conn->connect_error);
// 	} else {
// 		$stmt = $conn->prepare("insert into patient(Name, Date, Age, Birth_Date, Contact_No,Image,Status ) values(?,?,?,?,?,?,?)");
// 		$stmt->bind_param("ssisiss", $name,$date,$age,$date,$number,$image,$output);
// 		$execval = $stmt->execute();
// 		//echo $execval;
// 		echo "<script>alert('Patient Data Successfully Entered')</script>";
//     //header("Location: customer_details.php?name=$_name");
//     echo "<script>window.location.href='customer_details.php?name=$name'</script>";
//     // "Registration successfully...";
// 		$stmt->close();
// 		$conn->close();
// 	}

?>
