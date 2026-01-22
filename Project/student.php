<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InternConnectBD - Student Dashboard</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }
        
       
        .sidebar {
            width: 250px;
            background: linear-gradient(to bottom, #1e3c72, #2a5298);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-header h3 {
            margin: 0;
            color: white;
            font-size: 1.5em;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
            margin: 0;
        }
        
        .sidebar-menu li {
            margin: 5px 0;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }
        
        .sidebar-menu a:hover {
            background-color: rgba(255,255,255,0.1);
            border-left: 4px solid #4CAF50;
        }
        
        .sidebar-menu a.active {
            background-color: rgba(255,255,255,0.15);
            border-left: 4px solid #4CAF50;
        }
        
        .sidebar-menu i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .logout-btn {
            position: absolute;
            bottom: 20px;
            width: 100%;
        }
        
      
        .main-content {
            flex: 1;
            margin-left: 250px;
            display: flex;
            flex-direction: column;
        }
        
      
        .top-bar {
            background-color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .profile-pic-small {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #2a5298;
            cursor: pointer;
        }
        
        .student-info h2 {
            margin: 0;
            font-size: 1.2em;
            color: #333;
        }
        
        .student-info p {
            margin: 0;
            color: #666;
            font-size: 0.9em;
        }
        
        .notification-icon {
            position: relative;
            cursor: pointer;
            font-size: 1.2em;
            color: #666;
            padding: 10px;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ff4757;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7em;
            font-weight: bold;
        }
        
        
        .content-area {
            padding: 30px;
            flex: 1;
        }
        
       
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .dashboard-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        
        .card-icon {
            font-size: 2.5em;
            margin-bottom: 15px;
            color: #2a5298;
        }
        
        .card-title {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 5px;
        }
        
        .card-value {
            font-size: 2em;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
        
        .notifications-panel {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .section-title {
            font-size: 1.3em;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .notification-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .notification-item:last-child {
            border-bottom: none;
        }
        
        .notification-content {
            flex: 1;
        }
        
        .notification-message {
            color: #333;
            margin-bottom: 5px;
        }
        
        .notification-time {
            color: #666;
            font-size: 0.9em;
        }
        
        .notification-status {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #4CAF50;
        }
        
        /* Profile Page Styles */
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .profile-header {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 30px;
        }
        
        .profile-pic-large {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #2a5298;
        }
        
        .profile-info h1 {
            margin: 0 0 10px 0;
            color: #333;
        }
        
        .profile-info p {
            margin: 5px 0;
            color: #666;
        }
        
        .profile-edit-btn {
            background-color: #2a5298;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .profile-edit-btn:hover {
            background-color: #1e3c72;
        }
        
        .profile-sections {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }
        
        .profile-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .profile-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        .form-group label {
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .upload-group {
            border: 2px dashed #ddd;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
            transition: border-color 0.3s;
        }
        
        .upload-group:hover {
            border-color: #2a5298;
        }
        
        .upload-group input[type="file"] {
            display: none;
        }
        
        .upload-icon {
            font-size: 2em;
            color: #666;
            margin-bottom: 10px;
        }
        
        .upload-text {
            color: #666;
            margin-bottom: 5px;
        }
        
        .upload-hint {
            color: #999;
            font-size: 0.9em;
        }
        
        .form-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        
        .btn-primary {
            background-color: #2a5298;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #1e3c72;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        
        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        
        .skill-tag {
            background-color: #e3f2fd;
            color: #2a5298;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9em;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .skill-tag i {
            cursor: pointer;
            font-size: 0.8em;
        }
        
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        
        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .modal-header h3 {
            margin: 0;
            color: #333;
        }
        
        .close-btn {
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            color: #666;
        }
        
        
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
                transition: width 0.3s;
            }
            
            .sidebar.active {
                width: 250px;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
                background: none;
                border: none;
                font-size: 1.5em;
                color: #333;
                cursor: pointer;
            }
            
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
        }
        
       
        .active-nav {
            background-color: rgba(255,255,255,0.15);
            border-left: 4px solid #4CAF50;
        }
        
       
        .file-preview {
            margin-top: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3>InternConnectBD</h3>
        <p>Student Dashboard</p>
    </div>
    
    <ul class="sidebar-menu">
        <li><a href="#" class="active-nav" onclick="showSection('dashboard')">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a></li>
        <li><a href="#" onclick="showSection('internships')">
            <i class="fas fa-briefcase"></i> Nearby Internships
        </a></li>
        <li><a href="#" onclick="showSection('saved')">
            <i class="fas fa-bookmark"></i> Saved Internships
        </a></li>
        <li><a href="#" onclick="showSection('applications')">
            <i class="fas fa-file-alt"></i> My Applications
        </a></li>
        <li><a href="#" onclick="showSection('offers')">
            <i class="fas fa-handshake"></i> Job Offers
        </a></li>
        <li><a href="#" onclick="showSection('profile')">
            <i class="fas fa-user"></i> Profile
        </a></li>
        <li class="logout-btn"><a href="#" onclick="logout()" style="color: #ff6b6b;">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a></li>
    </ul>
</div>


<div class="main-content">
    
    <div class="top-bar">
        <div class="top-bar-left">
            <button class="menu-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <img src="https://via.placeholder.com/150" alt="Profile" class="profile-pic-small" id="profilePic" onclick="showSection('profile')">
            <div class="student-info">
                <h2 id="studentName">Student Name</h2>
                <p id="studentEmail">student@email.com</p>
            </div>
        </div>
        
        <div class="notification-icon" onclick="toggleNotifications()">
            <i class="fas fa-bell"></i>
            <span class="notification-badge">3</span>
        </div>
    </div>

   
<div id="dashboard" class="section">
    <h1 class="w3-xxlarge">Dashboard Overview</h1>
    
    <div class="dashboard-cards">
        <div class="dashboard-card">
            <div class="card-title">Total Applied Internships</div>
            <div class="card-value" id="appliedCount"></div>
            <div class="card-subtitle"></div>
        </div>
        
        <div class="dashboard-card">
            <div class="card-title">Shortlisted Applications</div>
            <div class="card-value" id="shortlistedCount"></div>
            <div class="card-subtitle"></div>
        </div>
        
        <div class="dashboard-card">
            <div class="card-title">Job Offers Received</div>
            <div class="card-value" id="offersCount"></div>
            <div class="card-subtitle"></div>
        </div>
        
        <div class="dashboard-card">
            <div class="card-title">Profile Strength</div>
            <div class="card-value"></div>
            <div class="card-subtitle"></div>
        </div>
    </div>
            
            <div class="notifications-panel">
                <h3 class="section-title">Recent Notifications</h3>
                <div class="notification-item">
                    <div class="notification-content">
                        <div class="notification-message">Your application at TechCorp has been reviewed</div>
                        <div class="notification-time">2 hours ago</div>
                    </div>
                    <div class="notification-status" style="background-color: #4CAF50;"></div>
                </div>
                <div class="notification-item">
                    <div class="notification-content">
                        <div class="notification-message">New internship matching your profile</div>
                        <div class="notification-time">1 day ago</div>
                    </div>
                    <div class="notification-status" style="background-color: #ff4757;"></div>
                </div>
                <div class="notification-item">
                    <div class="notification-content">
                        <div class="notification-message">Interview scheduled with Innovate Ltd.</div>
                        <div class="notification-time">2 days ago</div>
                    </div>
                    <div class="notification-status" style="background-color: #4CAF50;"></div>
                </div>
            </div>
        </div>

        <!-- Profile Section -->
        <div id="profile" class="section" style="display: none;">
            <div class="profile-container">
                <div class="profile-header">
                    <img src="https://via.placeholder.com/150" alt="Profile Picture" class="profile-pic-large" id="profilePicLarge">
                    <div class="profile-info">
                        <h1 id="displayFullName">Full Name</h1>
                        <p><i class="fas fa-envelope"></i> <span id="displayEmail">email@example.com</span></p>
                        <p><i class="fas fa-phone"></i> <span id="displayPhone">+880 1XXX XXXXXX</span></p>
                        <p><i class="fas fa-map-marker-alt"></i> Dhaka, Bangladesh</p>
                        <button class="profile-edit-btn" onclick="openEditProfileModal()">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                    </div>
                </div>
                
                <div class="profile-sections">
                    <!-- Personal Information -->
                    <div class="profile-section">
                        <h3 class="section-title">Personal Information</h3>
                        <div class="profile-form" id="personalInfoForm">
                            <div class="form-group">
                                <label for="fullName">Full Name</label>
                                <input type="text" id="fullName" placeholder="Enter your full name">
                            </div>
                            
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="tel" id="phoneNumber" placeholder="Enter your phone number">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" placeholder="Enter your email">
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea id="address" placeholder="Enter your address"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="education">Education Level</label>
                                <select id="education">
                                    <option value="">Select Education Level</option>
                                    <option value="undergraduate">Undergraduate</option>
                                    <option value="graduate">Graduate</option>
                                    <option value="postgraduate">Postgraduate</option>
                                    <option value="diploma">Diploma</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Account Security -->
                    <div class="profile-section">
                        <h3 class="section-title">Account Security</h3>
                        <div class="profile-form" id="securityForm">
                            <div class="form-group">
                                <label for="currentPassword">Current Password</label>
                                <input type="password" id="currentPassword" placeholder="Enter current password">
                            </div>
                            
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" id="newPassword" placeholder="Enter new password">
                            </div>
                            
                            <div class="form-group">
                                <label for="confirmPassword">Confirm New Password</label>
                                <input type="password" id="confirmPassword" placeholder="Confirm new password">
                            </div>
                            
                            <div class="form-buttons">
                                <button class="btn btn-primary" onclick="changePassword()">
                                    <i class="fas fa-key"></i> Change Password
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Skills -->
                    <div class="profile-section">
                        <h3 class="section-title">Skills</h3>
                        <div class="profile-form" id="skillsForm">
                            <div class="form-group">
                                <label for="newSkill">Add New Skill</label>
                                <input type="text" id="newSkill" placeholder="Enter a skill (e.g., JavaScript)">
                            </div>
                            
                            <div class="form-buttons">
                                <button class="btn btn-primary" onclick="addSkill()">
                                    <i class="fas fa-plus"></i> Add Skill
                                </button>
                            </div>
                            
                            <div class="skills-container" id="skillsList">
                                <!-- Skills will be added here -->
                            </div>
                        </div>
                    </div>
                    
                   
                    <div class="profile-section">
                        <h3 class="section-title">Documents</h3>
                        <div class="profile-form">
                            <!-- CV/Resume Upload -->
                            <div class="form-group">
                                <label>CV / Resume</label>
                                <div class="upload-group" onclick="document.getElementById('cvUpload').click()">
                                    <div class="upload-icon">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div class="upload-text">Upload CV (PDF) or Video Resume</div>
                                    <div class="upload-hint">Max size: 10MB</div>
                                    <input type="file" id="cvUpload" accept=".pdf,.mp4,.avi,.mov" onchange="handleCVUpload(this)">
                                </div>
                                <div id="cvPreview" class="file-preview" style="display: none;"></div>
                            </div>
                            
                            <!-- NID Upload -->
                            <div class="form-group">
                                <label>National ID (NID)</label>
                                <div class="upload-group" onclick="document.getElementById('nidUpload').click()">
                                    <div class="upload-icon">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                    <div class="upload-text">Upload NID (PDF/JPG/PNG)</div>
                                    <div class="upload-hint">Max size: 5MB</div>
                                    <input type="file" id="nidUpload" accept=".pdf,.jpg,.jpeg,.png" onchange="handleNIDUpload(this)">
                                </div>
                                <div id="nidPreview" class="file-preview" style="display: none;"></div>
                            </div>
                            
                            <!-- Profile Picture Upload -->
                            <div class="form-group">
                                <label>Profile Picture</label>
                                <div class="upload-group" onclick="document.getElementById('profilePicUpload').click()">
                                    <div class="upload-icon">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                    <div class="upload-text">Upload Profile Picture</div>
                                    <div class="upload-hint">JPG/PNG, Max size: 2MB</div>
                                    <input type="file" id="profilePicUpload" accept=".jpg,.jpeg,.png" onchange="handleProfilePicUpload(this)">
                                </div>
                                <div id="profilePicPreview" class="file-preview" style="display: none;"></div>
                            </div>
                            
                            <div class="form-buttons">
                                <button class="btn btn-primary" onclick="saveDocuments()">
                                    <i class="fas fa-save"></i> Save Documents
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other sections would go here -->
        <div id="internships" class="section" style="display: none;">
            <h1 class="w3-xxlarge">Nearby Internships</h1>
            <p>Internship listings will appear here.</p>
        </div>
        
        <div id="saved" class="section" style="display: none;">
            <h1 class="w3-xxlarge">Saved Internships</h1>
            <p>Your saved internships will appear here.</p>
        </div>
        
        <div id="applications" class="section" style="display: none;">
            <h1 class="w3-xxlarge">My Applications</h1>
            <p>Your internship applications will appear here.</p>
        </div>
        
        <div id="offers" class="section" style="display: none;">
            <h1 class="w3-xxlarge">Job Offers</h1>
            <p>Your job offers will appear here.</p>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Profile Information</h3>
            <button class="close-btn" onclick="closeEditProfileModal()">&times;</button>
        </div>
        <div class="profile-form">
            <div class="form-group">
                <label for="editFullName">Full Name</label>
                <input type="text" id="editFullName" placeholder="Enter your full name">
            </div>
            
            <div class="form-group">
                <label for="editPhone">Phone Number</label>
                <input type="tel" id="editPhone" placeholder="Enter your phone number">
            </div>
            
            <div class="form-group">
                <label for="editEmail">Email Address</label>
                <input type="email" id="editEmail" placeholder="Enter your email">
            </div>
            
            <div class="form-group">
                <label for="editEducation">Education Level</label>
                <select id="editEducation">
                    <option value="">Select Education Level</option>
                    <option value="undergraduate">Undergraduate</option>
                    <option value="graduate">Graduate</option>
                    <option value="postgraduate">Postgraduate</option>
                    <option value="diploma">Diploma</option>
                </select>
            </div>
            
            <div class="form-buttons">
                <button class="btn btn-primary" onclick="saveProfileChanges()">Save Changes</button>
                <button class="btn btn-secondary" onclick="closeEditProfileModal()">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Notifications Modal -->
<div id="notificationsModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Notifications</h3>
            <button class="close-btn" onclick="closeNotifications()">&times;</button>
        </div>
        <div id="notificationsList">
            
        </div>
    </div>
</div>

<script>
   // Initialize student data with default empty values
let studentData = {
    fullName: "",
    email: "",
    phone: "",
    address: "",
    education: "",
    skills: [], 
    cvFile: null,
    nidFile: null,
    profilePic: "https://via.placeholder.com/150"
};
    // Load data from localStorage
function loadStudentData() {
    const savedData = localStorage.getItem('studentData');
    if (savedData) {
        studentData = JSON.parse(savedData);
        updateDisplay();
    } else {
        // If no saved data
        updateDisplay();
    }
}
    // Save data to localStorage
    function saveStudentData() {
        localStorage.setItem('studentData', JSON.stringify(studentData));
    }

  
    function updateDisplay() {
        // Update top bar
        document.getElementById('studentName').textContent = studentData.fullName || "Student Name";
        document.getElementById('studentEmail').textContent = studentData.email || "student@email.com";
        document.getElementById('profilePic').src = studentData.profilePic;
        document.getElementById('profilePicLarge').src = studentData.profilePic;
        
        // Update profile page display
        document.getElementById('displayFullName').textContent = studentData.fullName || "Full Name";
        document.getElementById('displayEmail').textContent = studentData.email || "email@example.com";
        document.getElementById('displayPhone').textContent = studentData.phone || "+880 1XXX XXXXXX";
        
        // Update form fields
        document.getElementById('fullName').value = studentData.fullName || "";
        document.getElementById('phoneNumber').value = studentData.phone || "";
        document.getElementById('email').value = studentData.email || "";
        document.getElementById('address').value = studentData.address || "";
        document.getElementById('education').value = studentData.education || "";
        
        // Update modal fields
        document.getElementById('editFullName').value = studentData.fullName || "";
        document.getElementById('editPhone').value = studentData.phone || "";
        document.getElementById('editEmail').value = studentData.email || "";
        document.getElementById('editEducation').value = studentData.education || "";
        
        // Update skills list
        updateSkillsList();
    }

  
    function showSection(sectionId) {
        
        const sections = document.querySelectorAll('.section');
        sections.forEach(section => {
            section.style.display = 'none';
        });
        
       
        const activeSection = document.getElementById(sectionId);
        if (activeSection) {
            activeSection.style.display = 'block';
        }
        
        
        const navLinks = document.querySelectorAll('.sidebar-menu a');
        navLinks.forEach(link => {
            link.classList.remove('active-nav');
        });
        
        const activeLink = document.querySelector(`a[onclick*="${sectionId}"]`);
        if (activeLink) {
            activeLink.classList.add('active-nav');
        }
    }

    
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('active');
    }

    
    function openEditProfileModal() {
        document.getElementById('editProfileModal').style.display = 'block';
    }

    function closeEditProfileModal() {
        document.getElementById('editProfileModal').style.display = 'none';
    }

    function saveProfileChanges() {
        studentData.fullName = document.getElementById('editFullName').value;
        studentData.phone = document.getElementById('editPhone').value;
        studentData.email = document.getElementById('editEmail').value;
        studentData.education = document.getElementById('editEducation').value;
        
        saveStudentData();
        updateDisplay();
        closeEditProfileModal();
        alert('Profile updated successfully!');
    }

    // Change password
    function changePassword() {
        const currentPass = document.getElementById('currentPassword').value;
        const newPass = document.getElementById('newPassword').value;
        const confirmPass = document.getElementById('confirmPassword').value;
        
        if (!currentPass || !newPass || !confirmPass) {
            alert('Please fill in all password fields');
            return;
        }
        
        if (newPass !== confirmPass) {
            alert('New passwords do not match');
            return;
        }
        
        if (newPass.length < 6) {
            alert('Password must be at least 6 characters long');
            return;
        }
        
        // Clear password fields
        document.getElementById('currentPassword').value = '';
        document.getElementById('newPassword').value = '';
        document.getElementById('confirmPassword').value = '';
        
        alert('Password changed successfully!');
    }

    // Skills management
    function updateSkillsList() {
        const skillsList = document.getElementById('skillsList');
        skillsList.innerHTML = '';
        
        studentData.skills.forEach((skill, index) => {
            const skillTag = document.createElement('div');
            skillTag.className = 'skill-tag';
            skillTag.innerHTML = `
                ${skill}
                <i class="fas fa-times" onclick="removeSkill(${index})"></i>
            `;
            skillsList.appendChild(skillTag);
        });
    }

    function addSkill() {
        const newSkillInput = document.getElementById('newSkill');
        const newSkill = newSkillInput.value.trim();
        
        if (newSkill) {
            studentData.skills.push(newSkill);
            saveStudentData();
            updateSkillsList();
            newSkillInput.value = '';
        }
    }

    function removeSkill(index) {
        studentData.skills.splice(index, 1);
        saveStudentData();
        updateSkillsList();
    }

    // File upload handlers
    function handleCVUpload(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            studentData.cvFile = file.name;
            document.getElementById('cvPreview').innerHTML = 
                `Uploaded: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
            document.getElementById('cvPreview').style.display = 'block';
            saveStudentData();
        }
    }

    function handleNIDUpload(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            studentData.nidFile = file.name;
            document.getElementById('nidPreview').innerHTML = 
                `Uploaded: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
            document.getElementById('nidPreview').style.display = 'block';
            saveStudentData();
        }
    }

    function handleProfilePicUpload(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                studentData.profilePic = e.target.result;
                document.getElementById('profilePicPreview').innerHTML = 
                    `Uploaded: ${file.name} (${(file.size / 1024).toFixed(2)} KB)`;
                document.getElementById('profilePicPreview').style.display = 'block';
                updateDisplay();
                saveStudentData();
            }
            
            reader.readAsDataURL(file);
        }
    }

    function saveDocuments() {
        alert('Documents saved successfully!');
    }

    // Notifications
    function toggleNotifications() {
        const modal = document.getElementById('notificationsModal');
        modal.style.display = 'block';
        
        const notificationsList = document.getElementById('notificationsList');
        notificationsList.innerHTML = `
            <div class="notification-item">
                <div class="notification-content">
                    <div class="notification-message">Your application at TechCorp has been reviewed</div>
                    <div class="notification-time">2 hours ago</div>
                </div>
                <div class="notification-status" style="background-color: #4CAF50;"></div>
            </div>
            <div class="notification-item">
                <div class="notification-content">
                    <div class="notification-message">New internship matching your profile</div>
                    <div class="notification-time">1 day ago</div>
                </div>
                <div class="notification-status" style="background-color: #ff4757;"></div>
            </div>
            <div class="notification-item">
                <div class="notification-content">
                    <div class="notification-message">Interview scheduled with Innovate Ltd.</div>
                    <div class="notification-time">2 days ago</div>
                </div>
                <div class="notification-status" style="background-color: #4CAF50;"></div>
            </div>
        `;
    }

    function closeNotifications() {
        document.getElementById('notificationsModal').style.display = 'none';
    }

    // Logout function
   // Logout function
    function logout() {
    if (confirm('Are you sure you want to logout?')) {
        // Clear localStorage on logout
        localStorage.removeItem('studentData');
        window.location.href = 'logout.php';
    }
}

    // Close modals when clicking outside
    window.onclick = function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadStudentData();
        showSection('dashboard');
    });
</script>
</body>
</html>