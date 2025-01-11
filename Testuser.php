// Test user registration and login flow
public function testUserRegistrationAndLogin() {
    // Register a user
    $this->registerUser('testuser', 'password123');
    
    // Attempt to log in
    $response = $this->loginUser('testuser', 'password123');
    $this->assertEquals(200, $response->getStatusCode());
}
