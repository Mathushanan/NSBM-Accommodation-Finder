<?php
use PHPUnit\Framework\TestCase;

class RegistrationTest extends TestCase
{
    protected $formFields;

    protected function setUp(): void
    {
        $this->formFields = array(
            'user_type' => 'Landlord',
            'user_name' => 'John Doe',
            'user_email' => 'johndoe@example.com',
            'user_mobile' => '1234567890',
            'user_password' => 'password123',
            'user_cpassword' => 'password123',
            'user_gender' => 'Male'
        );
    }

    public function testValidRegistration()
    {
        $this->assertTrue($this->submitForm());
    }

    public function testDuplicateEmailRegistration()
    {
        // Submitting the form with a duplicate email
        $this->formFields['user_email'] = 'existinguser@example.com';
        $this->assertFalse($this->submitForm());
    }

    public function testMissingFields()
    {
        // Submitting the form with missing fields
        unset($this->formFields['user_name']);
        $this->assertFalse($this->submitForm());
    }

    public function testInvalidEmailFormat()
    {
        // Submitting the form with an invalid email format
        $this->formFields['user_email'] = 'invalidemail';
        $this->assertFalse($this->submitForm());
    }

    public function testPasswordMismatch()
    {
        // Submitting the form with mismatched passwords
        $this->formFields['user_cpassword'] = 'mismatchedpassword';
        $this->assertFalse($this->submitForm());
    }

    protected function submitForm()
    {
        // Mocking the $_POST global variable with form fields
        $_POST = $this->formFields;

        // Capturing the output buffer when including the script
        ob_start();
        include 'register.php';
        $output = ob_get_contents();
        ob_end_clean();

        // Checking if success message exists in the output
        return strpos($output, 'successfully registered') !== false;
    }
}
?>
