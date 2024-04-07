<?php
use PHPUnit\Framework\TestCase;

class WebAdminDashboardTest extends TestCase
{
    protected $connection;

    protected function setUp(): void
    {
        // Establish a mock connection
        $this->connection = $this->createMock(mysqli::class);
    }

    public function testUnauthorizedAccess()
    {
        // Simulate unauthorized access by not setting the user type in the session
        $_SESSION = array();
        $_SESSION['userEmail'] = 'test@example.com'; // Set a dummy email for session
        $_SESSION['userId'] = 1; // Set a dummy user ID for session

        ob_start(); // Start output buffering to capture header redirect
        include 'webadminDashboard.php'; // Include the script
        $output = ob_get_clean(); // Capture the output

        // Assert that the output contains a redirection header
        $this->assertStringContainsString('Location: login.php', $output);
    }

    public function testAllAccommodationsDisplayed()
    {
        // Mock database result set with sample property data
        $mockResultSet = $this->createMock(mysqli_result::class);
        $mockResultSet->expects($this->once())->method('fetch_assoc')->willReturn([
            'propertyId' => 123,
            'title' => 'Sample Property',
            'description' => 'This is a sample property description.',
            'bedCounts' => 3,
            'postedAt' => '2024-04-08',
            'rent' => '$1200',
            'status' => 'Accepted',
            'imageData' => base64_encode(file_get_contents('sample_image.jpg'))
        ]);
        
        // Expectations for database query to fetch all accommodations
        $this->connection->expects($this->once())->method('query')->willReturn($mockResultSet);
        
        // Call the script to be tested
        ob_start();
        include 'webadminDashboard.php';
        $output = ob_get_clean();

        // Assert that the output contains the sample property data
        $this->assertStringContainsString('Sample Property', $output);
        $this->assertStringContainsString('This is a sample property description.', $output);
        $this->assertStringContainsString('3', $output);
        $this->assertStringContainsString('2024-04-08', $output);
        $this->assertStringContainsString('$1200', $output);
        $this->assertStringContainsString('Available', $output);
        $this->assertStringContainsString('Accepted', $output);
    }

    // Add more test methods to cover other functionalities and scenarios

}
?>
