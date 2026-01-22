<?php
session_start();

include "db.php";


$student_message = "";
$company_message = "";
$student_success = false;
$company_success = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_POST['student_form'])) {
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password'];
        $retype_password = $_POST['retype_password'];
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $gender = isset($_POST['student_gender']) ? mysqli_real_escape_string($conn, $_POST['student_gender']) : "";
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        
       
        $valid = true;
        
        if (empty($full_name)) {
            $student_message = "Full name is required";
            $valid = false;
        } elseif (empty($email)) {
            $student_message = "Email is required";
            $valid = false;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $student_message = "Invalid email format";
            $valid = false;
        } elseif (empty($password)) {
            $student_message = "Password is required";
            $valid = false;
        } elseif (strlen($password) < 8) {
            $student_message = "Password must be at least 8 characters";
            $valid = false;
        } elseif ($password !== $retype_password) {
            $student_message = "Passwords do not match";
            $valid = false;
        } elseif (empty($phone)) {
            $student_message = "Phone number is required";
            $valid = false;
        } elseif (empty($gender)) {
            $student_message = "Please select gender";
            $valid = false;
        } elseif (empty($location) || $location == "") {
            $student_message = "Please select location";
            $valid = false;
        } elseif (empty($city) || $city == "") {
            $student_message = "Please select city";
            $valid = false;
        }
        
        if ($valid) {
            
            $check_email = "SELECT student_id FROM student_reg WHERE email = '$email'";
            $result = mysqli_query($conn, $check_email);
            
            if (mysqli_num_rows($result) > 0) {
                $student_message = "Email already registered. Please use a different email.";
            } else {
               
                $sql = "INSERT INTO student_reg (full_name, email, password, phone, gender, location, city) 
                        VALUES ('$full_name', '$email', '$password', '$phone', '$gender', '$location', '$city')";
                
                if (mysqli_query($conn, $sql)) {
                    $student_success = true;
                    $_SESSION['registration_success'] = "Student registration successful!";
                    
                   
                    header("Location: index.php");
                    exit();
                } else {
                    $student_message = "Error: " . mysqli_error($conn);
                }
            }
        }
    }

    
    if (isset($_POST['company_form'])) {
        $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password'];
        $retype_password = $_POST['retype_password'];
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        
      
        $valid = true;
        
        if (empty($company_name)) {
            $company_message = "Company name is required";
            $valid = false;
        } elseif (empty($email)) {
            $company_message = "Email is required";
            $valid = false;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $company_message = "Invalid email format";
            $valid = false;
        } elseif (empty($password)) {
            $company_message = "Password is required";
            $valid = false;
        } elseif (strlen($password) < 8) {
            $company_message = "Password must be at least 8 characters";
            $valid = false;
        } elseif ($password !== $retype_password) {
            $company_message = "Passwords do not match";
            $valid = false;
        } elseif (empty($phone)) {
            $company_message = "Phone number is required";
            $valid = false;
        } elseif (empty($location) || $location == "") {
            $company_message = "Please select location";
            $valid = false;
        } elseif (empty($description)) {
            $company_message = "Company description is required";
            $valid = false;
        }
        
        if ($valid) {
            
            $check_email = "SELECT company_id FROM company_reg WHERE email = '$email'";
            $result = mysqli_query($conn, $check_email);
            
            if (mysqli_num_rows($result) > 0) {
                $company_message = "Email already registered. Please use a different email.";
            } else {
               
                $sql = "INSERT INTO company_reg (company_name, email, password, phone, location, description) 
                        VALUES ('$company_name', '$email', '$password', '$phone', '$location', '$description')";
                
                if (mysqli_query($conn, $sql)) {
                    $company_success = true;
                    $_SESSION['registration_success'] = "Company registration successful!";
                    
                    
                    header("Location: index.php");
                    exit();
                } else {
                    $company_message = "Error: " . mysqli_error($conn);
                }
            }
        }
    }
}


$full_name_value = !empty($student_message) && isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : '';
$student_email_value = !empty($student_message) && isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$student_phone_value = !empty($student_message) && isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
$student_gender_value = !empty($student_message) && isset($_POST['student_gender']) ? $_POST['student_gender'] : '';
$student_location_value = !empty($student_message) && isset($_POST['location']) ? $_POST['location'] : '';
$student_city_value = !empty($student_message) && isset($_POST['city']) ? $_POST['city'] : '';

$company_name_value = !empty($company_message) && isset($_POST['company_name']) ? htmlspecialchars($_POST['company_name']) : '';
$company_email_value = !empty($company_message) && isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$company_phone_value = !empty($company_message) && isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
$company_location_value = !empty($company_message) && isset($_POST['location']) ? $_POST['location'] : '';
$company_description_value = !empty($company_message) && isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Intern Connect BD - Registration</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            line-height: 1.6;
            padding: 20px;
            padding-bottom: 80px; 
        }
        .header {
            background: white;
            padding: 15px 20px;
            border-bottom: 1px solid #eeeeee;
        }
        
        .nav {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .logo {
            color: blue;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }
        
        .logo span {
            color: green;
        }
        
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
       

        .account-type-selector {
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 40px;
            text-align: center;
        }
        
        .account-type-selector h2 {
            color: #333;
            margin-bottom: 25px;
            font-size: 22px;
        }
        
        .radio-options {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }
        
        .radio-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px;
            border: 2px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 280px;
        }
        
        .radio-option:hover {
            border-color: #3498db;
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.1);
        }
        
        .radio-option.selected {
            border-color: #3498db;
            background-color: rgba(52, 152, 219, 0.05);
        }
        
        .radio-option input[type="radio"] {
            display: none;
        }
        
        .radio-label {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
     
        
        .scroll-indicator {
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            color: #3498db;
            font-weight: bold;
            opacity: 0;
            transition: opacity 0.5s;
            font-size: 16px;
        }
        
        .scroll-indicator.visible {
            opacity: 1;
        }
        
        .form-container {
            width: 700px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: none;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        
        .form-container.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
        
        .form-header {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #3498db;
        }

        .form-header h2 {
           color: #333;
           margin-bottom: 8px;
           font-size: 24px;
        }

        .form-header p {
           color: #7f8c8d;
           font-size: 14px;
        }
        
        .form-row {
            margin-bottom: 20px;
        }
        
        .form-row label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
        }
        
        .form-row input,
        .form-row select,
        .form-row textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            font-family: "Times New Roman", Times, serif;
        }
        
        .form-row textarea {
            height: 120px;
            resize: vertical;
        }
        
        .form-row input:focus,
        .form-row select:focus,
        .form-row textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        
        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 5px;
        }
        
        .radio-group label {
            font-weight: normal;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .radio-group input[type="radio"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }
        
        .form-hint {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
        
        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        
        .button-group input[type="submit"],
        .button-group input[type="button"] {
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 150px;
        }
        
        .button-group input[type="submit"] {
            background-color: #3498db;
            color: white;
        }
        
        .button-group input[type="submit"]:hover {
            background-color: #2980b9;
        }
        
        .button-group input[type="button"] {
            background-color: #ecf0f1;
            color: #333;
        }
        
        .button-group input[type="button"]:hover {
            background-color: #d5dbdb;
        }
        
        .hidden {
            display: none;
        }
        
       
        .message {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
       
        .footer {
            background: rgba(77, 106, 119, 1);
            padding: 20px;
            text-align: center;
            margin-top: 30px;
            border-top: 1px solid #eeeeee;
            position: fixed;
            bottom: 0px;
            width: 100%;
            left: 0;
            z-index: 100;
        }
        
        .copyright {
            color: #ffffff;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="header">
        <div class="nav">
            <a href="index.php" class="logo">InternConnect<span>BD</span></a>
        </div>
    </div>

        
        <div class="account-type-selector">
            <h2>Select Account Type</h2>
            <div class="radio-options">
                <label class="radio-option" for="student-account">
                    <div class="radio-label">Student</div>
                    <input type="radio" id="student-account" name="account-type" value="student">
                </label>
                
                <label class="radio-option" for="company-account">
                    <div class="radio-label">Company</div>
                    <input type="radio" id="company-account" name="account-type" value="company">
                </label>
            </div>
        </div>
        
        <div class="scroll-indicator" id="scrollIndicator">
            ↓ Scroll down to complete your registration ↓
        </div>
        
        
        <div id="studentFormContainer" class="form-container">
            <div class="form-header">
                <h2>Student Registration</h2>
                <p>Start Your Internship Journey</p>
            </div>

            
            <?php if (!empty($student_message)): ?>
                <div class="message error">
                    <?php echo $student_message; ?>
                </div>
            <?php endif; ?>

            <form id="studentRegistrationForm" method="POST">
                <input type="hidden" name="student_form" value="1">
                
               
                <div class="form-row">
                    <label for="student_full_name">Full Name:</label>
                    <input type="text" id="student_full_name" name="full_name" required 
                           value="<?php echo $full_name_value; ?>">
                    <div class="error-message" id="studentNameError">Please enter your full name</div>
                </div>

               
                <div class="form-row">
                    <label for="student_email">Email:</label>
                    <input type="email" id="student_email" name="email" required
                           value="<?php echo $student_email_value; ?>">
                    <div class="error-message" id="studentEmailError">Please enter a valid email address</div>
                </div>

               
                <div class="form-row">
                    <label for="student_password">Password:</label>
                    <input type="password" id="student_password" name="password" required>
                    <div class="error-message" id="studentPasswordError">Password must be at least 8 characters</div>
                </div>

                
                <div class="form-row">
                    <label for="student_retype_password">Retype Password:</label>
                    <input type="password" id="student_retype_password" name="retype_password" required>
                    <div class="error-message" id="studentRetypePasswordError">Passwords do not match</div>
                </div>

               
                <div class="form-row">
                    <label for="student_phone">Phone Number:</label>
                    <input type="tel" id="student_phone" name="phone" required
                           value="<?php echo $student_phone_value; ?>">
                    <div class="error-message" id="studentPhoneError">Please enter a valid Bangladeshi phone number</div>
                </div>

               
                <div class="form-row">
                    <label>Gender:</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="student_gender" value="Male" required 
                                   <?php echo ($student_gender_value == 'Male') ? 'checked' : ''; ?>> Male
                        </label>
                        <label>
                            <input type="radio" name="student_gender" value="Female" required
                                   <?php echo ($student_gender_value == 'Female') ? 'checked' : ''; ?>> Female
                        </label>
                        <label>
                            <input type="radio" name="student_gender" value="Other" required
                                   <?php echo ($student_gender_value == 'Other') ? 'checked' : ''; ?>> Other
                        </label>
                    </div>
                    <div class="error-message" id="studentGenderError">Please select your gender</div>
                </div>

               
                <div class="form-row">
                    <label for="student_location">Location:</label>
                    <select id="student_location" name="location" required>
                        <option value="">Select Your Location</option>
                        <option value="Dhaka" <?php echo ($student_location_value == 'Dhaka') ? 'selected' : ''; ?>>Dhaka</option>
                        <option value="Chittagong" <?php echo ($student_location_value == 'Chittagong') ? 'selected' : ''; ?>>Chittagong</option>
                        <option value="Sylhet" <?php echo ($student_location_value == 'Sylhet') ? 'selected' : ''; ?>>Sylhet</option>
                        <option value="Khulna" <?php echo ($student_location_value == 'Khulna') ? 'selected' : ''; ?>>Khulna</option>
                        <option value="Rajshahi" <?php echo ($student_location_value == 'Rajshahi') ? 'selected' : ''; ?>>Rajshahi</option>
                        <option value="Barisal" <?php echo ($student_location_value == 'Barisal') ? 'selected' : ''; ?>>Barisal</option>
                        <option value="Rangpur" <?php echo ($student_location_value == 'Rangpur') ? 'selected' : ''; ?>>Rangpur</option>
                        <option value="Mymensingh" <?php echo ($student_location_value == 'Mymensingh') ? 'selected' : ''; ?>>Mymensingh</option>
                        <option value="Other" <?php echo ($student_location_value == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                    <div class="error-message" id="studentLocationError">Please select your location</div>
                </div>

                
                <div class="form-row">
                    <label for="student_city">City/District:</label>
                    <select id="student_city" name="city" required class="hidden">
                        <option value="">Select Division First</option>
                    </select>
                    <div class="error-message" id="studentCityError">Please select your city</div>
                </div>

              
                <div class="button-group">
                    <input type="submit" value="Sign up">
                    <input type="button" value="Reset" id="studentResetBtn">
                </div>
            </form>
        </div>
        
       
        <div id="companyFormContainer" class="form-container">
            <div class="form-header">
                <h2>Company Registration</h2>
                <p>Find Talented Interns</p>
            </div>

            
            <?php if (!empty($company_message)): ?>
                <div class="message error">
                    <?php echo $company_message; ?>
                </div>
            <?php endif; ?>

            <form id="companyRegistrationForm" method="POST">
                <input type="hidden" name="company_form" value="1">
                
              
                <div class="form-row">
                    <label for="company_name">Company Name:</label>
                    <input type="text" id="company_name" name="company_name" required
                           value="<?php echo $company_name_value; ?>">
                    <div class="error-message" id="companyNameError">Please enter the company name</div>
                </div>

               
                <div class="form-row">
                    <label for="company_email">Email:</label>
                    <input type="email" id="company_email" name="email" required
                           value="<?php echo $company_email_value; ?>">
                    <div class="error-message" id="companyEmailError">Please enter a valid email address</div>
                </div>

               
                <div class="form-row">
                    <label for="company_password">Password:</label>
                    <input type="password" id="company_password" name="password" required>
                    <div class="error-message" id="companyPasswordError">Password must be at least 8 characters</div>
                </div>

               
                <div class="form-row">
                    <label for="company_retype_password">Retype Password:</label>
                    <input type="password" id="company_retype_password" name="retype_password" required>
                    <div class="error-message" id="companyRetypePasswordError">Passwords do not match</div>
                </div>

               
                <div class="form-row">
                    <label for="company_phone">Phone Number:</label>
                    <input type="tel" id="company_phone" name="phone" required
                           value="<?php echo $company_phone_value; ?>">
                    <div class="error-message" id="companyPhoneError">Please enter a valid Bangladeshi phone number</div>
                </div>

               
                <div class="form-row">
                    <label for="company_location">Location:</label>
                    <select id="company_location" name="location" required>
                        <option value="">Select Your Location</option>
                        <option value="Dhaka" <?php echo ($company_location_value == 'Dhaka') ? 'selected' : ''; ?>>Dhaka</option>
                        <option value="Chittagong" <?php echo ($company_location_value == 'Chittagong') ? 'selected' : ''; ?>>Chittagong</option>
                        <option value="Sylhet" <?php echo ($company_location_value == 'Sylhet') ? 'selected' : ''; ?>>Sylhet</option>
                        <option value="Khulna" <?php echo ($company_location_value == 'Khulna') ? 'selected' : ''; ?>>Khulna</option>
                        <option value="Rajshahi" <?php echo ($company_location_value == 'Rajshahi') ? 'selected' : ''; ?>>Rajshahi</option>
                        <option value="Barisal" <?php echo ($company_location_value == 'Barisal') ? 'selected' : ''; ?>>Barisal</option>
                        <option value="Rangpur" <?php echo ($company_location_value == 'Rangpur') ? 'selected' : ''; ?>>Rangpur</option>
                        <option value="Mymensingh" <?php echo ($company_location_value == 'Mymensingh') ? 'selected' : ''; ?>>Mymensingh</option>
                        <option value="Other" <?php echo ($company_location_value == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                    <div class="error-message" id="companyLocationError">Please select your location</div>
                </div>

               
                <div class="form-row">
                    <label for="company_description">Description:</label>
                    <textarea id="company_description" name="description" required placeholder="Briefly describe your company, industry, and what you're looking for in interns"><?php echo $company_description_value; ?></textarea>
                    <div class="form-hint">Maximum 500 characters</div>
                    <div class="error-message" id="companyDescriptionError">Please enter a clear information about your company</div>
                </div>

                
                <div class="button-group">
                    <input type="submit" value="Sign up">
                    <input type="button" value="Reset" id="companyResetBtn">
                </div>
            </form>
        </div>
    </div>

    
    <div class="footer">
        <p class="copyright">© 2025 InternConnectBD. All rights reserved.</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
           
            const studentRadio = document.getElementById('student-account');
            const companyRadio = document.getElementById('company-account');
            const radioOptions = document.querySelectorAll('.radio-option');
            const studentFormContainer = document.getElementById('studentFormContainer');
            const companyFormContainer = document.getElementById('companyFormContainer');
            const scrollIndicator = document.getElementById('scrollIndicator');
            
           
            const cityData = {
                'Dhaka': ['Dhaka', 'Gazipur', 'Narayanganj', 'Tangail', 'Kishoreganj', 'Manikganj', 'Munshiganj', 'Narsingdi', 'Faridpur', 'Rajbari', 'Gopalganj', 'Madaripur', 'Shariatpur'],
                'Chittagong': ['Chittagong', 'Cox\'s Bazar', 'Rangamati', 'Bandarban', 'Khagrachhari', 'Feni', 'Lakshmipur', 'Comilla', 'Noakhali', 'Chandpur', 'Brahmanbaria'],
                'Sylhet': ['Sylhet', 'Moulvibazar', 'Habiganj', 'Sunamganj'],
                'Khulna': ['Khulna', 'Bagerhat', 'Satkhira', 'Jessore', 'Narail', 'Magura', 'Jhenaidah', 'Kushtia', 'Chuadanga', 'Meherpur'],
                'Rajshahi': ['Rajshahi', 'Natore', 'Naogaon', 'Chapainawabganj', 'Pabna', 'Bogra', 'Joypurhat', 'Sirajganj'],
                'Barisal': ['Barisal', 'Pirojpur', 'Patuakhali', 'Bhola', 'Jhalokati', 'Barguna'],
                'Rangpur': ['Rangpur', 'Dinajpur', 'Gaibandha', 'Kurigram', 'Lalmonirhat', 'Nilphamari', 'Panchagarh', 'Thakurgaon'],
                'Mymensingh': ['Mymensingh', 'Jamalpur', 'Netrokona', 'Sherpur'],
                'Other': ['Other']
            };
            
            
            function showRegistrationSection(section) {
                
                studentFormContainer.classList.remove('active');
                companyFormContainer.classList.remove('active');
                
                
                section.classList.add('active');
                
               
                radioOptions.forEach(option => option.classList.remove('selected'));
                if (section === studentFormContainer) {
                    studentRadio.checked = true;
                    document.querySelector('label[for="student-account"]').classList.add('selected');
                } else {
                    companyRadio.checked = true;
                    document.querySelector('label[for="company-account"]').classList.add('selected');
                }
                
               
                scrollIndicator.classList.add('visible');
                
                
                setTimeout(() => {
                    section.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'start'
                    });
                }, 300);
            }
            
            studentRadio.addEventListener('change', function() {
                if (this.checked) {
                    showRegistrationSection(studentFormContainer);
                }
            });
            
            companyRadio.addEventListener('change', function() {
                if (this.checked) {
                    showRegistrationSection(companyFormContainer);
                }
            });
            
        
            radioOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const radioInput = this.querySelector('input[type="radio"]');
                    radioInput.checked = true;
                    
                    if (radioInput.id === 'student-account') {
                        showRegistrationSection(studentFormContainer);
                    } else {
                        showRegistrationSection(companyFormContainer);
                    }
                });
            });
            
            
            const studentLocationSelect = document.getElementById('student_location');
            const studentCitySelect = document.getElementById('student_city');
            
            
            const initialLocation = studentLocationSelect.value;
            if (initialLocation && cityData[initialLocation]) {
                studentCitySelect.classList.remove('hidden');
                studentCitySelect.innerHTML = '<option value="">Select City/District</option>';
                
                cityData[initialLocation].forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    
                    <?php if (!empty($student_city_value)): ?>
                        if (city === '<?php echo $student_city_value; ?>') {
                            option.selected = true;
                        }
                    <?php endif; ?>
                    studentCitySelect.appendChild(option);
                });
            }
            
            studentLocationSelect.addEventListener('change', function() {
                const selectedLocation = this.value;
                studentCitySelect.innerHTML = '<option value="">Select City/District</option>';
                
                if (selectedLocation && cityData[selectedLocation]) {
                    studentCitySelect.classList.remove('hidden');
                    
                    cityData[selectedLocation].forEach(city => {
                        const option = document.createElement('option');
                        option.value = city;
                        option.textContent = city;
                        studentCitySelect.appendChild(option);
                    });
                } else {
                    studentCitySelect.classList.add('hidden');
                }
            });
            
           
            document.getElementById('studentResetBtn').addEventListener('click', function() {
                
                document.getElementById('student_full_name').value = '';
                document.getElementById('student_email').value = '';
                document.getElementById('student_password').value = '';
                document.getElementById('student_retype_password').value = '';
                document.getElementById('student_phone').value = '';
                
                const genderRadios = document.querySelectorAll('input[name="student_gender"]');
                genderRadios.forEach(radio => radio.checked = false);
                
                document.getElementById('student_location').selectedIndex = 0;
                studentCitySelect.classList.add('hidden');
                studentCitySelect.innerHTML = '<option value="">Select Division First</option>';
            });
            
            document.getElementById('companyResetBtn').addEventListener('click', function() {
                
                document.getElementById('company_name').value = '';
                document.getElementById('company_email').value = '';
                document.getElementById('company_password').value = '';
                document.getElementById('company_retype_password').value = '';
                document.getElementById('company_phone').value = '';
                document.getElementById('company_location').selectedIndex = 0;
                document.getElementById('company_description').value = '';
            });
            
           
            window.addEventListener('scroll', function() {
                const scrollPosition = window.scrollY;
                const studentFormPosition = studentFormContainer.offsetTop;
                const companyFormPosition = companyFormContainer.offsetTop;
                const formPosition = Math.min(studentFormPosition, companyFormPosition);
                
                if (scrollPosition > formPosition - 100) {
                    scrollIndicator.classList.remove('visible');
                } else if (studentRadio.checked || companyRadio.checked) {
                    scrollIndicator.classList.add('visible');
                }
            });
            
            
            <?php if (!empty($student_message)): ?>
                showRegistrationSection(studentFormContainer);
            <?php elseif (!empty($company_message)): ?>
                showRegistrationSection(companyFormContainer);
            <?php endif; ?>
            
            
        });
    </script>
</body>
</html>