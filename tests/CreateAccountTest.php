<?php
use PHPUnit\Framework\TestCase;

class CreateAccountTest extends TestCase
{
    // Mock the database connection
    private $connectionMock;

    protected function setUp(): void
    {
        // Create a mock object for the database connection
        $this->connectionMock = $this->getMockBuilder(mysqli::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testValidRegistration()
    {
        // Simulate form submission with valid input data
        $_POST = [
            'user_type' => 'Landlord',
            'user_name' => 'John Doe',
            'user_email' => 'john.doe@example.com',
            'user_mobile' => '1234567890',
            'user_password' => 'password',
            'user_cpassword' => 'password',
            'user_gender' => 'Male',
            'submit' => 'CREATE'
        ];

        // Mock the database query result
        $this->connectionMock->expects($this->once())
            ->method('query')
            ->willReturn(true);

        // Include the PHP script for registration
        ob_start();
        include("createAccount.php");
        $output = ob_get_clean();

        // Assert success message
        $this->assertStringContainsString('You are successfully created a Landlord account!', $output);
    }

    public function testExistingEmailRegistration()
    {
        // Simulate form submission with existing email
        $_POST = [
            'user_type' => 'Warden',
            'user_name' => 'Jane Doe',
            'user_email' => 'existing@example.com',
            'user_mobile' => '1234567890',
            'user_password' => 'password',
            'user_cpassword' => 'password',
            'user_gender' => 'Female',
            'submit' => 'CREATE'
        ];

        // Mock the database query result
        $this->connectionMock->expects($this->once())
            ->method('query')
            ->willReturn(false); // Simulate query failure

        // Include the PHP script for registration
        ob_start();
        include("register.php");
        $output = ob_get_clean();

        // Assert error message for existing email
        $this->assertStringContainsString('This email address is already registered!', $output);
    }

}
