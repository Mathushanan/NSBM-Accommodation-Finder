<?php
use PHPUnit\Framework\TestCase;

class UserLoginTest extends TestCase
{
  public function testValidStudentLoginRedirectsToStudentDashboard()
  {
      // Simulate form submission with valid student credentials
      $_POST['user_email'] = 'student@example.com';
      $_POST['user_password'] = 'studentpassword';
  
      // Mock the database connection and query result
  
      // Replace the global variable with the mock connection
      $GLOBALS['connection'] = $connectionMock;
  
      // Include the login script
      ob_start();
      include("login.php");
      $output = ob_get_clean();
  
      // Assert redirection to student dashboard
      $this->assertStringContainsString("Location: studentDashboard.php", xdebug_get_headers());
  }
  
  public function testInvalidLoginDisplaysErrorMessage()
  {
      // Simulate form submission with invalid credentials
      $_POST['user_email'] = 'invalid@example.com';
      $_POST['user_password'] = 'invalidpassword';
  
      // Mock the database connection and query result
  
      // Replace the global variable with the mock connection
      $GLOBALS['connection'] = $connectionMock;
  
      // Include the login script
      ob_start();
      include("login.php");
      $output = ob_get_clean();
  
      // Assert presence of error message
      $this->assertStringContainsString("<div class='errorMessageBox'>", $output);
  }
  
  public function testValidWebAdminLoginRedirectsToWebAdminDashboard()
  {
      // Simulate form submission with valid web admin credentials
      $_POST['user_email'] = 'webadmin@example.com';
      $_POST['user_password'] = 'webadminpassword';
  
      // Mock the database connection and query result
  
      // Replace the global variable with the mock connection
      $GLOBALS['connection'] = $connectionMock;
  
      // Include the login script
      ob_start();
      include("login.php");
      $output = ob_get_clean();
  
      // Assert redirection to web admin dashboard
      $this->assertStringContainsString("Location: webadminDashboard.php", xdebug_get_headers());
  }
  
}
?>
